<?php

namespace App\Http\Controllers\Kader;

use App\Http\Controllers\Controller;
use App\Models\PengukuranFisik;
use App\Models\Warga;
use Illuminate\Http\Request;

class PengukuranFisikController extends Controller
{
    /**
     * HALAMAN INDEX: Menampilkan daftar riwayat pengukuran.
     */
    public function index(Request $request)
    {
        $kader = auth('kader')->user();
        
        $query = PengukuranFisik::with(['warga', 'kader'])
            ->whereHas('warga', function($q) use ($kader) {
                $q->where('unit_posyandu_id', $kader->unit_posyandu_id);
            });

        // Pencarian Nama atau NIK
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->whereHas('warga', function($q) use ($search) {
                $q->where('nama_lengkap', 'like', "%{$search}%")
                  ->orWhere('nik', 'like', "%{$search}%");
            });
        }

        // Filter Dropdown Kategori
        if ($request->has('kategori') && in_array($request->kategori, ['Balita', 'Remaja', 'Lansia'])) {
            $query->where('kategori_saat_ukur', $request->kategori);
        }

        $pengukuran = $query->orderBy('tanggal_ukur', 'desc')->paginate(10)->withQueryString();

        return view('kader.pengukuran.index', compact('pengukuran'));
    }

    /**
     * HALAMAN CREATE: Form dinamis berdasarkan kategori.
     */
    public function create(Request $request)
    {
        $kader = auth('kader')->user();
        
        // Default menampilkan form Balita jika tidak ada parameter GET
        $kategoriAktif = $request->kategori ?? 'Balita';
        
        // Mengambil daftar warga spesifik untuk unit kader tersebut dan kategori yang dipilih
        $warga = Warga::where('unit_posyandu_id', $kader->unit_posyandu_id)
                      ->where('status', 'aktif')
                      ->where('kategori', $kategoriAktif)
                      ->orderBy('nama_lengkap', 'asc')
                      ->get(['id', 'nama_lengkap', 'nik', 'kategori']);

        return view('kader.pengukuran.create', compact('warga', 'kategoriAktif'));
    }

    /**
     * PROSES STORE: Validasi, Kalkulasi, dan Normalisasi Data.
     */
    public function store(Request $request)
    {
        $kader = auth('kader')->user();

        // 1. Validasi Input Lengkap
        $validated = $request->validate([
            'warga_id'           => 'required|exists:warga,id',
            'tanggal_ukur'       => 'required|date',
            'kategori_saat_ukur' => 'required|in:Balita,Remaja,Lansia',
            'berat_badan'        => 'nullable|numeric|min:0',
            'tinggi_badan'       => 'nullable|numeric|min:0',
            'lingkar_kepala'     => 'nullable|numeric|min:0',
            'lila'               => 'nullable|numeric|min:0',
            'lingkar_perut'      => 'nullable|numeric|min:0',
            'status_stunting'    => 'nullable|in:normal,pendek,sangat_pendek,tinggi',
            'sistol'             => 'nullable|integer|min:0',
            'diastol'            => 'nullable|integer|min:0',
            'gula_darah'         => 'nullable|integer|min:0',
            'kolesterol'         => 'nullable|integer|min:0',
            'asam_urat'          => 'nullable|numeric|min:0',
            'hemoglobin'         => 'nullable|numeric|min:0',
            'status_kemandirian' => 'nullable|in:mandiri,bantuan_ringan,bantuan_penuh',
            'catatan'            => 'nullable|string',
        ]);

        // 2. Keamanan Lapis Kedua (Anti-IDOR)
        // Memastikan warga yang dikirim dari form benar-benar warga di Posyandu milik Kader
        $warga = Warga::findOrFail($validated['warga_id']);
        if ($warga->unit_posyandu_id != $kader->unit_posyandu_id) {
            abort(403, 'Akses Ditolak. Warga tidak terdaftar di Unit Anda.');
        }

        $validated['kader_id'] = $kader->id;

        // 3. Kalkulasi IMT Otomatis (Remaja & Lansia)
        if (in_array($validated['kategori_saat_ukur'], ['Remaja', 'Lansia']) && !empty($validated['berat_badan']) && !empty($validated['tinggi_badan'])) {
            $tb_meter = $validated['tinggi_badan'] / 100;
            if ($tb_meter > 0) {
                $validated['imt'] = round($validated['berat_badan'] / ($tb_meter * $tb_meter), 2);
            }
        }

        // 4. Normalisasi Basis Data (Cleansing Data)
        // Agar database bersih, kita paksa NULL kolom yang tidak sesuai dengan kategori
        if ($validated['kategori_saat_ukur'] === 'Balita') {
            $validated['sistol']             = null; 
            $validated['diastol']            = null; 
            $validated['imt']                = null;
            $validated['lingkar_perut']      = null;
            $validated['lila']               = null;
            $validated['hemoglobin']         = null;
            $validated['gula_darah']         = null; 
            $validated['kolesterol']         = null; 
            $validated['asam_urat']          = null;
            $validated['status_kemandirian'] = null;
        } elseif ($validated['kategori_saat_ukur'] === 'Remaja') {
            $validated['lingkar_kepala']     = null; 
            $validated['status_stunting']    = null;
            $validated['gula_darah']         = null; 
            $validated['kolesterol']         = null; 
            $validated['asam_urat']          = null;
            $validated['status_kemandirian'] = null;
        } elseif ($validated['kategori_saat_ukur'] === 'Lansia') {
            $validated['lingkar_kepala']     = null; 
            $validated['status_stunting']    = null;
        }

        // 5. Simpan Data
        PengukuranFisik::create($validated);

        return redirect()->route('kader.pengukuran.index')
                         ->with('success', 'Data pengukuran fisik berhasil dicatat.');
    }

    // 4. HALAMAN SHOW: Detail Profil Warga
    public function show(Warga $warga)
    {
        $kader = auth('kader')->user();
        
        // Anti-IDOR: Pastikan kader hanya melihat warga dari unitnya sendiri
        if ($warga->unit_posyandu_id != $kader->unit_posyandu_id) {
            abort(403, 'Akses Ditolak. Warga tidak terdaftar di Unit Posyandu Anda.');
        }

        return view('kader.warga.show', compact('warga'));
    }

    // 5. HALAMAN EDIT: Form Pembaruan Data
    public function edit(Warga $warga)
    {
        $kader = auth('kader')->user();
        
        if ($warga->unit_posyandu_id != $kader->unit_posyandu_id) {
            abort(403, 'Akses Ditolak.');
        }

        return view('kader.warga.edit', compact('warga'));
    }

    // 6. PROSES UPDATE: Validasi & Simpan Perubahan
    public function update(Request $request, Warga $warga)
    {
        $kader = auth('kader')->user();

        if ($warga->unit_posyandu_id != $kader->unit_posyandu_id) {
            abort(403, 'Akses Ditolak.');
        }

        $validated = $request->validate([
            'nama_lengkap'  => 'required|string|max:255',
            // Pengecualian validasi unique untuk NIK milik warga ini sendiri
            'nik'           => 'required|string|size:16|unique:warga,nik,' . $warga->id,
            'tanggal_lahir' => 'required|date|before:today',
            'jenis_kelamin' => 'required|in:L,P',
            'kategori'      => 'required|in:Balita,Remaja,Lansia',
            'alamat'        => 'required|string|max:500',
            'no_hp'         => 'nullable|string|max:20',
            'status'        => 'required|in:aktif,pending,nonaktif'
        ], [
            'nik.unique' => 'NIK ini sudah terdaftar di sistem SIPOSDIG.',
            'nik.size'   => 'Format NIK tidak valid (Wajib 16 digit).',
        ]);

        $warga->update($validated);

        return redirect()->route('kader.warga.index')
                         ->with('success', 'Data Warga Binaan berhasil diperbarui.');
    }

    // 7. PROSES HAPUS (Opsional/Sesuai Kebutuhan)
    public function destroy(Warga $warga)
    {
        $kader = auth('kader')->user();
        if ($warga->unit_posyandu_id != $kader->unit_posyandu_id) {
            abort(403, 'Akses Ditolak.');
        }

        $warga->delete();
        return redirect()->route('kader.warga.index')->with('success', 'Data warga berhasil dihapus.');
    } 

    
}