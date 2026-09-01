<?php

namespace App\Http\Controllers\Warga;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class ProfilController extends Controller
{
    public function index()
    {
        $warga = auth('warga')->user();
        return view('warga.profil.index', compact('warga'));
    }

    public function updateProfil(Request $request)
    {
        $warga = auth('warga')->user();

        // Hanya izinkan field yang aman untuk diganti sendiri
        $validated = $request->validate([
            'no_hp' => 'nullable|string|max:15',
            'alamat' => 'required|string|max:500',
        ]);

        $warga->update($validated);

        return back()->with('success', 'Informasi kontak berhasil diperbarui.');
    }

    public function updatePassword(Request $request)
    {
        $warga = auth('warga')->user();

        $validated = $request->validate([
            'current_password' => 'required|string',
            'password' => ['required', 'confirmed', Password::min(8)], // Wajib 8 karakter + konfirmasi
        ]);

        // Cek apakah password lama yang dimasukkan cocok dengan database
        if (!Hash::check($validated['current_password'], $warga->password)) {
            return back()->withErrors(['current_password' => 'Password saat ini tidak sesuai.']);
        }

        $warga->update([
            'password' => Hash::make($validated['password']),
            'wajib_ganti_password' => false // Cabut status wajib ganti setelah berhasil
        ]);

        return back()->with('success', 'Password berhasil diubah.');
    }
}