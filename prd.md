# PRD — SIPOSDIG (Sistem Informasi Posyandu Digital)

**Versi:** 0.1 (Draft untuk didiskusikan)
**Stack:** Laravel 13 (PHP 8.3+), MySQL, Livewire 3 + Alpine.js, Tailwind CSS v4
**Referensi visual:** Mockup dashboard Admin (Google Stitch) — dipakai sebagai baseline palet & layout

---

## 1. Latar Belakang

Posyandu saat ini banyak mencatat data balita, remaja, dan lansia secara manual (kertas/Excel terpisah), sehingga rawan hilang, sulit direkap, dan warga tidak punya akses melihat riwayat tumbuh kembang/kesehatannya sendiri. SIPOSDIG menggantikan proses ini dengan satu sistem berbasis role (Admin, Kader, Warga) yang mendigitalkan pencatatan, verifikasi akun, pelaporan, dan edukasi kesehatan.

## 2. Tujuan Produk

1. Mendigitalkan pencatatan kader (absensi, pengukuran fisik) agar bebas dari risiko data hilang/rusak.
2. Memberi warga akses mandiri untuk memantau tumbuh kembang & kesehatan mereka sendiri, sesuai kategori usia.
3. Memberi admin kendali penuh atas siapa yang boleh masuk sistem (verifikasi manual berbasis NIK) dan pengelolaan unit posyandu.
4. Menghasilkan laporan siap pakai (PDF, filter periode/unit) untuk pelaporan ke Puskesmas/Dinkes.

## 3. Role & Skema Autentikasi

Sistem memakai **3 guard terpisah** (bukan satu tabel users dengan kolom role), karena field login dan siklus hidup akun tiap role berbeda total. ini sesuai dengan yang diminta agar controller, model, dan alur benar-benar terpisah per role.

| Role | Identitas Login | Sumber Password | Dibuat Oleh | Status Awal |
|---|---|---|---|---|
| **Admin** | Email | Ditentukan manual saat seeding awal (akun tetap/paten) | Seeder/manual | Aktif langsung |
| **Kader** | Email | Digenerate sistem saat admin menambahkan kader | Admin (CRUD Kelola Kader) | Aktif langsung |
| **Warga** | NIK (16 digit) | Digenerate sistem otomatis **saat admin menyetujui (approve)** pendaftaran | Diri sendiri (self-register) → disetujui Admin | `pending` → `aktif` |

### 3.1 Alur Login (satu halaman, deteksi otomatis)
Satu form login dipakai untuk ketiga role — sistem yang menentukan guard mana yang dicoba, berdasarkan format input:

1. Input berupa **16 digit angka** → dicoba sebagai NIK ke guard `warga`.
2. Input berupa **format email** → dicoba ke guard `admin` dahulu, jika tidak ditemukan → guard `kader`.
3. Jika akun warga berstatus `pending` atau `nonaktif`, tampilkan pesan status yang jelas (bukan "email/password salah") — misal "Akun Anda masih menunggu verifikasi Admin".

> **Catatan koreksi:** login dengan NIK murni (tanpa password custom pertama kali) secara keamanan tetap aman selama password disertai secara terpisah ke warga (lihat 3.3) dan sistem **mewajibkan ganti password di login pertama** — saya tambahkan ini sebagai lapisan keamanan minimum, karena NIK bukan rahasia (banyak dokumen mencantumkannya).

### 3.2 Alur Registrasi Warga (self-service)
1. Warga membuka halaman **Registrasi** dari menu login.
2. Input: Nama Lengkap, NIK, Tanggal Lahir, Jenis Kelamin, Alamat, No. HP, Unit Posyandu terdekat (dropdown), Nama Anggota Keluarga yang diukur (jika mendaftarkan balita atas nama anak).
3. Sistem menyimpan sebagai baris `warga` berstatus `pending`, **password NULL** (belum aktif, belum bisa login).
4. Halaman sukses: "Pendaftaran berhasil, silakan tunggu konfirmasi Admin."
5. Admin melihat entri ini di **Verifikasi Akun** (lihat 4.1), mengecek kecocokan NIK, lalu:
   - **Setujui** → sistem generate password acak (contoh: 8 karakter alfanumerik), hash otomatis, status → `aktif`.
   - **Tolak** → status → `ditolak` + kolom `catatan_admin` (alasan).
6. **Penyampaian kredensial** (pengganti WA blast yang dihapus): Admin melihat password hasil generate **satu kali** di layar konfirmasi (dengan tombol salin) dan wajib menyampaikannya manual ke warga. Sistem juga mencetak "Kartu Akun" (PDF kecil, NIK + password) yang bisa diprint/screenshot admin untuk diserahkan.
   > *Saran:* meskipun WA blast dihapus dari fase ini, saya desain kolom `notifikasi` & event `WargaDisetujui` supaya nanti tinggal ditambah listener WA/Email tanpa mengubah struktur inti — jadi tidak perlu refactor besar kalau suatu saat WA blast ingin diaktifkan lagi.

### 3.3 Reset & Keamanan Password
- Warga & Kader: fitur "Lupa Password" ditangani lewat Admin (klik "Reset Password" di Kelola Pengguna → sistem generate ulang password baru).
- Wajib ganti password di login pertama kali (flag `wajib_ganti_password` pada tabel `warga`/`kader`).

## 4. Modul per Role

### 4.1 Admin
Berdasarkan referensi mockup yang dikirim + masukan saya:

| Fitur | Detail |
|---|---|
| **Dashboard** | Ringkasan: jumlah unit posyandu, kader aktif, warga per kategori, antrean verifikasi, aktivitas terbaru, jam sistem |
| **Verifikasi Akun** | List pendaftar `pending`, detail data diri, tombol Setujui/Tolak, riwayat verifikasi |
| **Kelola Kader** | CRUD penuh: tambah kader (auto-generate email/password), tetapkan unit posyandu, nonaktifkan (bukan hapus permanen — soft delete) |
| **Kelola Warga** | CRUD penuh, filter kategori (Balita/Remaja/Lansia), filter unit posyandu, reset password, nonaktifkan |
| **Unit Posyandu** | CRUD data posyandu (nama, wilayah, alamat, penanggung jawab) — **ini saya tambahkan** karena di mockup terlihat ada banyak unit posyandu (bukan 1 posyandu tunggal); kader & warga terikat ke satu unit |
| **Pendidikan Kesehatan** | CMS materi edukasi: judul, konten, gambar, target kategori (Balita/Remaja/Lansia/Semua) — tampil otomatis ke warga sesuai kategorinya |
| **Log Aktivitas** | Audit trail semua aksi penting (login, approve, edit data, hapus) — pakai `spatie/laravel-activitylog` |
| **Pengaturan** | Identitas aplikasi (nama, logo), ambang batas usia kategori (agar tidak hard-code), *(WA blast dihapus dari scope ini)* |

### 4.2 Kader
| Fitur | Detail |
|---|---|
| **Dashboard** | Jadwal posyandu terdekat, ringkasan warga binaan di unitnya, warga yang belum diukur bulan ini |
| **Absensi** | Catat kehadiran warga per sesi posyandu (tanggal, unit, daftar hadir), riwayat absensi dengan filter tanggal & pagination |
| **Pengukuran Fisik** | Form dinamis sesuai kategori warga yang dipilih (lihat 4.2.1), riwayat per warga, grafik tren |
| **Kelola Data Warga** | CRUD warga binaan di unitnya (bukan lintas unit), form khusus per kategori |
| **Laporan** | Export PDF (rekap pengukuran/absensi per periode & kategori), **Import Excel** (migrasi data lama), filter periode/kategori/unit + pagination di semua tabel data historis |
| **Saran/Catatan** | Menambahkan catatan/saran kesehatan ke warga tertentu, terhubung ke hasil pengukuran tertentu |

**4.2.1 Field pengukuran fisik per kategori** (form otomatis menyesuaikan):
- **Balita:** berat badan, tinggi/panjang badan, lingkar kepala, lingkar lengan atas (LILA), status gizi (BB/U, TB/U, BB/TB — dihitung otomatis dari standar antropometri), status imunisasi.
- **Remaja:** berat badan, tinggi badan, IMT otomatis, lingkar lengan (skrining anemia/KEK opsional), tekanan darah opsional.
- **Lansia:** berat badan, tinggi badan, tekanan darah (sistol/diastol), gula darah, kolesterol (opsional), IMT, skrining PTM (Penyakit Tidak Menular) sederhana (ya/tidak per gejala).

> **Catatan:** ambang usia (misal Balita 0–59 bulan, Remaja 10–18 tahun, Lansia ≥60 tahun) dibuat **configurable** di tabel `pengaturan`, bukan hard-code, supaya bisa disesuaikan tanpa ubah kode.

### 4.3 Warga
| Fitur | Detail |
|---|---|
| **Dashboard Adaptif** | Tampilan otomatis menyesuaikan kategori (Balita/Remaja/Lansia) berdasarkan usia — widget & metrik yang tampil berbeda per kategori (lihat 4.3.1) |
| **Riwayat Pengukuran** | Grafik tren (berat/tinggi/tekanan darah, dst sesuai kategori) + tabel riwayat |
| **Saran dari Kader** | Daftar catatan/rekomendasi dari kader, terurut waktu |
| **Edukasi Kesehatan** | Materi dari Admin yang otomatis difilter sesuai kategori warga |
| **Profil** | Data diri (view only untuk data inti seperti NIK; hanya No. HP/foto yang bisa diedit warga sendiri) |

**4.3.1 Contoh penyesuaian dashboard otomatis:**
- **Balita** (akun dipegang orang tua): grafik KMS (kurva pertumbuhan), status gizi terkini dengan indikator warna (normal/waspada/stunting), reminder imunisasi.
- **Remaja**: IMT & kategori berat badan ideal, materi edukasi kesehatan reproduksi/gizi remaja, tren berat/tinggi.
- **Lansia**: tren tekanan darah & gula darah (grafik garis dengan garis ambang normal), pengingat kontrol rutin, materi edukasi penyakit tidak menular.

> **Pertanyaan terbuka untuk Anda:** Posyandu standar Kemenkes biasanya mencakup 5 sasaran (Balita, Remaja, **Ibu Hamil**, **Ibu Menyusui**, Lansia). Anda hanya menyebut 3. Saya desain skema agar kategori tetap **fleksibel/bisa ditambah** tanpa refactor besar, tapi mohon dikonfirmasi: apakah Ibu Hamil/Menyusui sengaja di luar scope v1, atau perlu dimasukkan sekarang?

## 5. Entitas Data (ringkas)

| Tabel | Fungsi |
|---|---|
| `admin` | Akun administrator |
| `kader` | Akun kader, relasi ke `unit_posyandu` |
| `warga` | Akun warga (status pending/aktif/ditolak/nonaktif), relasi ke `unit_posyandu` |
| `unit_posyandu` | Master data lokasi/unit posyandu |
| `absensi` | Kehadiran warga per sesi |
| `pengukuran_fisik` | Hasil ukur (kolom umum + kolom spesifik kategori, nullable) |
| `saran_kader` | Catatan/rekomendasi kader ke warga |
| `edukasi_kesehatan` | Materi edukasi + target kategori |
| `log_aktivitas` | Audit trail |
| `notifikasi` | Notifikasi in-app (bell icon) |
| `pengaturan` | Key-value setting aplikasi (ambang usia, identitas app, dll) |

Detail kolom akan dibahas satu per satu saat implementasi field (sesuai permintaan Anda) — file migrasi sudah di-generate lewat perintah terminal terpisah.

## 6. Kebutuhan Non-Fungsional
- **Keamanan:** password di-hash (bcrypt/argon2 default Laravel), rate limiting login, policy per role (kader hanya akses data unitnya sendiri), NIK unik & divalidasi 16 digit.
- **Skalabilitas:** mendukung banyak unit posyandu sekaligus (multi-unit, bukan single-tenant).
- **Responsif:** mobile-first untuk halaman Warga (asumsi banyak warga akses dari HP), desktop-first untuk Admin/Kader (input data lebih nyaman di layar besar, tapi tetap fungsional di tablet).
- **Aksesibilitas:** kontras warna cukup (khusus elemen glass, lihat DESIGN.md), reduced-motion dihormati.
- **Auditability:** semua perubahan data penting tercatat di `log_aktivitas`.

## 7. Asumsi & Hal yang Perlu Dikonfirmasi
1. Ibu Hamil/Menyusui masuk scope atau tidak (lihat 4.3).
2. Satu akun warga = satu individu yang diukur. Jika satu KK ingin mendaftarkan beberapa balita sekaligus dengan 1 akun (misal orang tua dengan 2 anak balita), perlu modul "Anggota Keluarga" tambahan — mohon konfirmasi apakah ini dibutuhkan di v1.
3. Kader hanya bisa mengelola warga di unit posyandunya sendiri (asumsi saya) — bukan lintas unit.
4. Password warga tidak dikirim otomatis (WA/email) di v1 — disampaikan manual oleh admin/kader.

## 8. Out of Scope (v1)
- Integrasi WA Blast (dihapus sesuai instruksi terakhir — arsitektur tetap disiapkan agar mudah ditambahkan nanti).
- Aplikasi mobile native (fokus web responsif dulu).