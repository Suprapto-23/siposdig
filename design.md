# DESIGN.md — Sistem Desain SIPOSDIG

## 1. Filosofi Desain

Tujuan: **premium, modern, minimalis, terang (light) — bukan "AI slop"**. Ciri khas UI generik yang harus dihindari: gradient ungu-biru berlebihan tanpa alasan, shadow menumpuk di semua elemen, ikon emoji generik, satu font untuk semua tanpa hierarki, dan glassmorphism dipakai di *semua* elemen sekaligus sehingga teks susah dibaca.

**Keputusan desain (bukan default template):**
- Glassmorphism dipakai **selektif**, bukan di seluruh halaman:
  - **Dipakai penuh** di: layar Login, Registrasi, halaman sukses, loading screen, modal konfirmasi, kartu notifikasi/alert.
  - **Dipakai minimal (aksen saja)** di: dashboard & tabel data (Admin/Kader) — kartu statistik boleh glass, tapi tabel & form input harus tetap solid/opaque agar mudah dibaca (data kesehatan itu penting, tidak boleh dikorbankan demi estetika).
- Ilustrasi mengikuti gaya flat-illustration konsisten (seperti pada mockup Google Stitch yang dikirim) — satu gaya ilustrasi saja dari awal sampai akhir, jangan campur beberapa gaya icon set.
- Signature element: **loading screen dengan animasi Lottie "detak jantung/keluarga sehat"** yang muncul saat transisi login → dashboard, jadi satu momen premium yang diingat, bukan animasi bertebaran di semua tempat.

## 2. Palet Warna

Diturunkan dari mockup yang Anda kirim (biru bersih, latar putih, aksen lembut per kategori) — clean & modern, tanpa dark mode:

| Token | Hex | Pemakaian |
|---|---|---|
| `--color-primary` | `#2563EB` | Aksi utama, tombol, link, sidebar aktif |
| `--color-primary-light` | `#DBEAFE` | Background lembut, hover state |
| `--color-primary-dark` | `#1E40AF` | Teks di atas primary-light, hover tombol |
| `--color-accent-kader` | `#8B5CF6` | Aksen khusus role Kader (ungu lembut, dari ikon "Petugas Kader" di mockup) |
| `--color-accent-warga` | `#0D9488` | Aksen khusus role Warga (teal, kesan "sehat/hidup") |
| `--color-success` | `#10B981` | Status aktif, berhasil |
| `--color-warning` | `#F59E0B` | Status pending/menunggu verifikasi |
| `--color-danger` | `#EF4444` | Ditolak, hapus, error |
| `--color-info` | `#3B82F6` | Info netral |
| `--color-surface` | `#FFFFFF` | Kartu, panel |
| `--color-bg` | `#F5F8FF` | Latar halaman (biru sangat muda) |
| `--color-text-primary` | `#0F172A` | Teks utama (slate-900) |
| `--color-text-secondary` | `#64748B` | Teks sekunder (slate-500) |
| `--color-border` | `#E2E8F0` | Garis pemisah, border kartu |

**Aturan role-color:** setiap role punya 1 warna identitas (Admin = biru primer, Kader = ungu, Warga = teal) — dipakai konsisten di sidebar/navbar aktif state & badge, supaya user langsung sadar sedang login sebagai siapa.

## 3. Tipografi

- **Heading/Display:** `Plus Jakarta Sans` (600–700) — karakter tegas tapi ramah, tidak generik seperti Inter-untuk-segalanya.
- **Body/UI:** `Inter` (400–500) — tetap dipakai untuk body karena keterbacaan angka (data kesehatan banyak angka) sangat baik di Inter.
- **Angka data (measurement, tabel):** `Inter` dengan `font-variant-numeric: tabular-nums` agar angka rapi sejajar di tabel.

Skala: `text-xs`(12) `text-sm`(14) `text-base`(16) `text-lg`(18) `text-xl`(20) `text-2xl`(24) `text-3xl`(30) — ikuti skala default Tailwind, jangan custom scale supaya konsisten.

## 4. Spesifikasi Glassmorphism

```css
.glass-card {
  background: rgba(255, 255, 255, 0.55);
  backdrop-filter: blur(20px);
  -webkit-backdrop-filter: blur(20px);
  border: 1px solid rgba(255, 255, 255, 0.6);
  box-shadow: 0 8px 32px rgba(37, 99, 235, 0.08);
  border-radius: 20px;
}

/* Background dekoratif di belakang glass (untuk halaman login) */
.glass-bg-blob {
  background: radial-gradient(circle at 20% 20%, #DBEAFE 0%, transparent 50%),
              radial-gradient(circle at 80% 80%, #E0F2FE 0%, transparent 50%);
}
```

**Aturan kontras (penting, sering diabaikan):** teks di atas elemen glass wajib punya latar penyangga minimal opacity 80% (bukan langsung di atas blur transparan) supaya tetap lolos rasio kontras WCAG AA — khusus label/isi form di halaman login, gunakan input dengan background solid putih 92% opacity, bukan full-transparent.

## 5. Komponen Kunci

### 5.1 Alert / Toast Premium
- Posisi: top-right, slide-in + fade, auto-dismiss 4 detik dengan progress bar tipis di bawah.
- Struktur: ikon bulat berwarna sesuai jenis (success/warning/danger/info) + judul + deskripsi singkat + border kiri 4px warna semantik + background glass tipis.
- Library: **SweetAlert2** untuk alert modal (konfirmasi hapus/approve), custom toast component (Blade + Alpine) untuk notifikasi ringan — SweetAlert2 di-custom class agar ikut tema glass (`customClass` + CSS override), bukan tampilan default SweetAlert.

### 5.2 Sidebar & Navbar
- Sidebar: fixed, collapsible (ikon saja saat collapsed), warna aktif mengikuti role-color, badge notifikasi merah kecil di menu bila ada item pending.
- Navbar atas: search global, ikon lonceng notifikasi (dropdown glass panel), avatar + role label — sesuai pola di mockup yang dikirim.

### 5.3 Kartu Statistik (Dashboard)
- Ikon dalam kotak rounded dengan background tint lembut dari warna kategori (pola yang sama seperti di mockup: ikon hijau untuk unit, ungu untuk kader, biru untuk warga, kuning untuk verifikasi).

### 5.4 Form Dinamis Pengukuran Fisik
- Field yang tampil berubah otomatis berdasarkan dropdown kategori warga yang dipilih (pakai Livewire `wire:model` reactive, tanpa reload halaman) — field non-relevan disembunyikan, bukan disabled (supaya form tidak terasa penuh sesak).

## 6. Animasi & Lottie

### 6.1 Prinsip
Animasi dipakai di titik keputusan/transisi penting saja: loading awal, sukses registrasi, empty state, error state. **Bukan** di setiap hover/klik — supaya tetap terasa premium bukan ramai.

### 6.2 Rekomendasi Lottie per Layar
| Layar | Jenis Animasi | Sumber (link asli, unduh manual) |
|---|---|---|
| Loading screen (splash) | Denyut/heartbeat halus, loop | https://lottiefiles.com/free-animation/heartbeat-medical-pPbWnDhphP |
| Kategori animasi kesehatan lain | Browse tema "Health" | https://lottiefiles.com/free-animations/health |
| Kategori medical app umum | Browse tema medical app | https://lottiefiles.com/free-animations/medical-app |
| Sukses registrasi | Checkmark animasi | https://lottiefiles.com/free-animations/success-check |
| Empty state (tabel kosong, dsb) | Browse tema sesuai konteks | cari di https://lottiefiles.com/free-animations dengan keyword "empty state" |

> **Catatan jujur soal "download lewat terminal":** LottieFiles **tidak menyediakan URL unduh JSON publik yang stabil** untuk di-`curl` langsung — tombol Download di web mereka memuat file lewat request yang butuh sesi/JS, jadi `curl -O` ke link acak berisiko 404 atau salah file (saya tidak mau kasih Anda link palsu yang nanti error). Alur paling realistis dan tetap efisien:
> 1. Buka link di atas → klik **Download → Lottie JSON** (bukan dotLottie) → simpan ke `~/Downloads`.
> 2. Pindahkan lewat terminal ke folder project sekali jalan:
> ```bash
> mkdir -p public/assets/lottie
> mv ~/Downloads/*.json public/assets/lottie/
> ```
> 3. Beri nama jelas: `loading.json`, `success.json`, `empty-state.json`.
>
> Yang **memang bisa** sepenuhnya diinstal lewat terminal adalah **player-nya** (lihat SETUP-COMMANDS.md, bagian npm) — `@lottiefiles/dotlottie-wc`, sehingga di Blade tinggal:
> ```html
> <dotlottie-wc src="/assets/lottie/loading.json" autoplay loop style="width:280px;height:280px"></dotlottie-wc>
> ```

### 6.3 Fallback
Jika animasi gagal load (jaringan lambat), tampilkan spinner solid warna primary sebagai fallback — jangan biarkan layar kosong.

## 7. Responsif
- Breakpoint: mengikuti default Tailwind (`sm`640 `md`768 `lg`1024 `xl`1280).
- Sidebar Admin/Kader otomatis jadi bottom-sheet/off-canvas di bawah `md`.
- Dashboard Warga didesain **mobile-first** (asumsi mayoritas warga akses dari HP saat di rumah).

## 8. Aksesibilitas
- Kontras teks minimum 4.5:1 di semua state (termasuk di atas glass — lihat 4).
- Semua ikon aksi (tombol icon-only di tabel) punya `aria-label`.
- Hormati `prefers-reduced-motion`: matikan animasi Lottie non-esensial dan ganti transisi jadi fade sederhana.