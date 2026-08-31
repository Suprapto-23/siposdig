<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Warga; // Pastikan model Warga sudah ada
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class VerifikasiAkunController extends Controller
{
    /**
     * Menampilkan daftar antrean verifikasi warga.
     */
    public function index(Request $request)
    {
        // Menangkap filter dari request (default: pending)
        $status = $request->query('status', 'pending');
        $search = $request->query('search');

        // Query dasar
        $query = Warga::with('unitPosyandu')->where('status', $status);

        // Filter pencarian berdasarkan NIK atau Nama
        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('nama_lengkap', 'like', "%{$search}%")
                  ->orWhere('nik', 'like', "%{$search}%");
            });
        }

        // Ambil data dengan pagination (10 per halaman)
        $antreanWarga = $query->latest()->paginate(10)->withQueryString();

        return view('admin.verifikasi.index', compact('antreanWarga', 'status', 'search'));
    }

    /**
     * Menyetujui pendaftaran dan meng-generate password.
     */
    public function approve(Request $request, $id)
    {
        $warga = Warga::findOrFail($id);

        if ($warga->status !== 'pending') {
            return redirect()->back()->with('error', 'Pendaftaran ini sudah diverifikasi sebelumnya.');
        }

        // Generate password acak (8 karakter) sesuai PRD
        $plainPassword = Str::random(8);

        // Update status dan simpan password
        $warga->update([
            'status' => 'aktif',
            'password' => Hash::make($plainPassword),
            'wajib_ganti_password' => true, // Memaksa warga ganti password saat login pertama kali
            'catatan_admin' => null
        ]);

        // Kirim plain password ke session secara flash (hanya bisa dilihat sekali)
        return redirect()->back()
            ->with('success', "Akun warga {$warga->nama_lengkap} berhasil disetujui.")
            ->with('generated_password', $plainPassword)
            ->with('warga_id', $warga->id);
    }

    /**
     * Menolak pendaftaran dengan catatan alasan.
     */
    public function reject(Request $request, $id)
    {
        $request->validate([
            'catatan_admin' => 'required|string|max:255'
        ], [
            'catatan_admin.required' => 'Alasan penolakan wajib diisi.'
        ]);

        $warga = Warga::findOrFail($id);

        if ($warga->status !== 'pending') {
            return redirect()->back()->with('error', 'Pendaftaran ini sudah diverifikasi sebelumnya.');
        }

        // Update status menjadi ditolak
        $warga->update([
            'status' => 'ditolak',
            'catatan_admin' => $request->catatan_admin
        ]);

        return redirect()->back()->with('success', 'Pendaftaran berhasil ditolak.');
    }
}