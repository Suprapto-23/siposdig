<?php

namespace App\Http\Controllers\Warga;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class ProfilController extends Controller
{
    public function index()
    {
        $warga = Auth::guard('warga')->user();
        $warga->load('unitPosyandu'); // Muat relasi unit posyandu

        return view('warga.profil.index', compact('warga'));
    }

    public function updateProfil(Request $request)
    {
        $warga = Auth::guard('warga')->user();

        // Validasi: Warga hanya diizinkan mengubah kontak & alamat. 
        // NIK, Nama, dan Tgl Lahir dikunci agar data medis tetap valid.
        $request->validate([
            'no_hp'  => 'nullable|string|max:20',
            'alamat' => 'required|string|max:500',
        ]);

        $warga->update([
            'no_hp'  => $request->no_hp,
            'alamat' => $request->alamat,
        ]);

        return back()->with('success', 'Data kontak dan alamat berhasil diperbarui.');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password'         => 'required|min:8|confirmed',
        ], [
            'password.min'       => 'Kata sandi baru minimal 8 karakter.',
            'password.confirmed' => 'Konfirmasi kata sandi tidak cocok.',
        ]);

        $warga = Auth::guard('warga')->user();

        // Cek apakah password lama (current password) benar
        if (!Hash::check($request->current_password, $warga->password)) {
            throw ValidationException::withMessages([
                'current_password' => 'Kata sandi saat ini tidak sesuai.'
            ]);
        }

        // Update password baru dan matikan flag wajib ganti password
        $warga->update([
            'password' => Hash::make($request->password),
            'wajib_ganti_password' => false,
        ]);

        return back()->with('success', 'Keamanan akun diperbarui! Kata sandi berhasil diganti.');
    }
}