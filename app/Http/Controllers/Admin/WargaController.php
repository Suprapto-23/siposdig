<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Warga;
use App\Models\UnitPosyandu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class WargaController extends Controller
{
    /**
     * 1. Menampilkan daftar warga binaan (Kecuali yang berstatus 'pending')
     */
    public function index(Request $request)
{
    // Ubah logika: Tampilkan semua yang statusnya bukan 'pending' dan bukan 'nonaktif' 
    // Atau tampilkan semua kecuali yang murni 'pending' (karena pending diurus di verifikasi)
    $query = Warga::with('unitPosyandu')->where(function($q) {
        $q->where('status', '!=', 'pending')
          ->orWhereNull('status');
    });

    if ($request->has('search') && $request->search != '') {
        $search = $request->search;
        $query->where(function($q) use ($search) {
            $q->where('nama_lengkap', 'like', "%{$search}%")
              ->orWhere('nik', 'like', "%{$search}%");
        });
    }

    $warga = $query->latest()->paginate(12)->withQueryString();
    $unitPosyandu = UnitPosyandu::orderBy('nama', 'asc')->get();

    return view('admin.warga.index', compact('warga', 'unitPosyandu'));
}

    /**
     * 2. Menampilkan form tambah warga baru
     */
    public function create()
    {
        $unitPosyandu = UnitPosyandu::orderBy('nama', 'asc')->get();
        return view('admin.warga.create', compact('unitPosyandu'));
    }

    /**
     * 3. Menyimpan data warga baru ke database
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_lengkap'     => 'required|string|max:255',
            'nik'              => 'required|string|size:16|unique:warga,nik',
            'unit_posyandu_id' => 'required|exists:unit_posyandu,id',
            'tanggal_lahir'    => 'required|date|before:today',
            'jenis_kelamin'    => 'required|in:L,P',
            'kategori'         => 'required|in:Balita,Remaja,Lansia',
            'alamat'           => 'required|string|max:500',
            'no_hp'            => 'nullable|string|max:20',
            'status'           => 'required|in:aktif,nonaktif'
        ], [
            'nik.unique' => 'Pendaftaran gagal: NIK ini sudah terdaftar di sistem.',
            'nik.size'   => 'Format NIK tidak valid (Wajib tepat 16 digit).',
        ]);

        // Standar Keamanan: Password awal menggunakan NIK & wajib diganti saat login pertama
        $validated['password'] = Hash::make($validated['nik']);
        $validated['wajib_ganti_password'] = true;

        Warga::create($validated);

        return redirect()->route('admin.warga.index')->with('success', 'Data Warga Binaan berhasil ditambahkan.');
    }

    /**
     * 4. Menampilkan detail spesifik profil warga
     */
    public function show(Warga $warga)
    {
        // Memuat relasi agar query efisien saat merender riwayat di halaman show
        $warga->load(['unitPosyandu', 'pengukuranFisik' => function($q) {
            $q->latest('tanggal_ukur')->limit(5); // Tarik 5 riwayat terakhir saja untuk efisiensi
        }]);
        
        return view('admin.warga.show', compact('warga'));
    }

    /**
     * 5. Menampilkan form pembaruan data warga
     */
    public function edit(Warga $warga)
    {
        $unitPosyandu = UnitPosyandu::orderBy('nama', 'asc')->get();
        return view('admin.warga.edit', compact('warga', 'unitPosyandu'));
    }

    /**
     * 6. Memproses pembaruan data ke database
     */
    public function update(Request $request, Warga $warga)
    {
        $validated = $request->validate([
            'nama_lengkap'     => 'required|string|max:255',
            // Pengecualian unik untuk NIK miliknya sendiri (Menggunakan kelas Rule)
            'nik'              => ['required', 'string', 'size:16', Rule::unique('warga')->ignore($warga->id)],
            'unit_posyandu_id' => 'required|exists:unit_posyandu,id',
            'tanggal_lahir'    => 'required|date|before:today',
            'jenis_kelamin'    => 'required|in:L,P',
            'kategori'         => 'required|in:Balita,Remaja,Lansia',
            'alamat'           => 'required|string|max:500',
            'no_hp'            => 'nullable|string|max:20',
            'status'           => 'required|in:aktif,nonaktif'
        ], [
            'nik.unique' => 'Pembaruan gagal: NIK ini sudah dipakai oleh warga lain.',
            'nik.size'   => 'Format NIK tidak valid (Wajib 16 digit).',
        ]);

        $warga->update($validated);

        return redirect()->route('admin.warga.index')->with('success', 'Data warga berhasil diperbarui.');
    }

    /**
     * 7. Menghapus data warga (Hati-hati, cascading ke tabel riwayat)
     */
    public function destroy(Warga $warga)
    {
        $warga->delete();
        return redirect()->route('admin.warga.index')->with('success', 'Data warga beserta riwayat pemeriksaannya berhasil dihapus.');
    }

    /**
     * 8. Fitur Reset Password (Kembali ke NIK)
     * Dipanggil melalui metode POST dari tabel Admin Warga
     */
    public function resetPassword(Warga $warga)
    {
        $warga->update([
            'password' => Hash::make($warga->nik),
            'wajib_ganti_password' => true
        ]);

        return redirect()->back()->with('success', "Kata sandi untuk {$warga->nama_lengkap} berhasil diatur ulang menjadi NIK.");
    }
    
}