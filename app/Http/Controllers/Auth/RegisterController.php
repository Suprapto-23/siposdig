<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class RegisterController extends Controller
{
    public function create(): View
    {
        return view('auth.register');
    }

    public function store(Request $request): RedirectResponse
    {
        // TODO: validasi NIK 16 digit unik + simpan ke tabel `warga` (status: pending).
        // Untuk sekarang langsung redirect ke halaman sukses supaya UI bisa dipratinjau.
        return redirect()->route('register.success');
    }

    public function success(): View
    {
        return view('auth.register-success');
    }
}