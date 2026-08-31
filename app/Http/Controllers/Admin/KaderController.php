<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kader;
use App\Models\UnitPosyandu;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class KaderController extends Controller
{
    /**
     * Tampilkan daftar kader dengan fitur pencarian.
     */
    public function index(Request $request)
    {
        $search = $request->query('search');

        // Eager loading relasi unitPosyandu untuk menghindari N+1 Query Problem
        $query = Kader::with('unitPosyandu');

        if ($search) {
            $query->where('nama_lengkap', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
        }

        $kaders = $query->latest()->paginate(10)->withQueryString();

        return view('admin.kader.index', compact('kaders', 'search'));
    }

    /**
     * Tampilkan form tambah kader baru.
     */
    public function create()
    {
        // Ambil semua unit posyandu untuk mengisi pilihan Dropdown
        $unitPosyandus = UnitPosyandu::orderBy('nama', 'asc')->get();
        return view('admin.kader.create', compact('unitPosyandus'));
    }

    /**
     * Simpan data kader baru ke database & Generate Password.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:kader,email',
            'unit_posyandu_id' => 'required|exists:unit_posyandu,id',
        ], [
            'email.unique' => 'Email ini sudah terdaftar. Gunakan email lain.',
            'unit_posyandu_id.exists' => 'Unit Posyandu tidak valid.'
        ]);

        // Generate password acak 8 karakter
        $plainPassword = Str::random(8);

        // Buat akun kader
        $kader = Kader::create([
            'nama_lengkap' => $request->nama_lengkap,
            'email' => $request->email,
            'unit_posyandu_id' => $request->unit_posyandu_id,
            'password' => Hash::make($plainPassword),
            'wajib_ganti_password' => true,
            'status' => 'aktif',
        ]);

        // Kembalikan ke halaman index dengan flash message sukses & password sementara
        return redirect()->route('admin.kader.index')
            ->with('success', "Akun Kader {$kader->nama_lengkap} berhasil dibuat!")
            ->with('generated_password', $plainPassword);
    }

    /**
     * Tampilkan form edit data kader.
     */
    public function edit(string $id)
    {
        $kader = Kader::findOrFail($id);
        $unitPosyandus = UnitPosyandu::orderBy('nama', 'asc')->get();
        
        return view('admin.kader.edit', compact('kader', 'unitPosyandus'));
    }

    /**
     * Update data kader (termasuk ganti status Aktif/Nonaktif).
     */
    public function update(Request $request, string $id)
    {
        $kader = Kader::findOrFail($id);

        $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:kader,email,' . $kader->id,
            'unit_posyandu_id' => 'required|exists:unit_posyandu,id',
            'status' => 'required|in:aktif,nonaktif',
        ], [
            'email.unique' => 'Email ini sudah digunakan oleh kader lain.'
        ]);

        $kader->update([
            'nama_lengkap' => $request->nama_lengkap,
            'email' => $request->email,
            'unit_posyandu_id' => $request->unit_posyandu_id,
            'status' => $request->status,
        ]);

        return redirect()->route('admin.kader.index')
            ->with('success', 'Data profil kader berhasil diperbarui.');
    }

    /**
     * Hapus data kader (Opsional jika ingin hapus permanen).
     * Namun disarankan cukup ubah status ke nonaktif di method update.
     */
    public function destroy(string $id)
    {
        $kader = Kader::findOrFail($id);
        $kader->delete();

        return redirect()->route('admin.kader.index')
            ->with('success', 'Akun kader berhasil dihapus permanen.');
    }
}