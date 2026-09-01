<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Warga;
use App\Models\UnitPosyandu;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        // Ambil data unit posyandu agar warga bisa memilih unit terdekat
        $units = UnitPosyandu::orderBy('nama', 'asc')->get();
        return view('auth.register', compact('units'));
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'nik' => 'required|digits:16|unique:warga,nik',
            'nama' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date|before:today',
            'jenis_kelamin' => 'required|in:L,P',
            'alamat' => 'required|string',
            'no_hp' => 'nullable|string|max:15',
            'unit_posyandu_id' => 'required|exists:unit_posyandu,id',
        ]);

        // Sesuai PRD: Warga baru berstatus pending dan password NULL (belum aktif)
        $validated['status'] = 'pending';
        $validated['password'] = null;
        $validated['wajib_ganti_password'] = true;

        Warga::create($validated);

        return redirect()->route('register.success')->with('success', 'Pendaftaran berhasil dikirim. Silakan tunggu konfirmasi Admin.');
    }

    public function success()
    {
        return view('auth.register-success');
    }
}