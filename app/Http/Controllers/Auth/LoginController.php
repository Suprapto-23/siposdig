<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function create()
    {
        return view('auth.login');
    }

    public function store(Request $request)
    {
        // 1. Validasi Input Dasar
        $request->validate([
            'identity' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        $loginField = $request->identity;
        $password = $request->password;
        $remember = $request->boolean('remember');

        // 2. Deteksi: Jika input adalah 16 digit angka, arahkan ke Guard Warga (Menyusul)
        if (is_numeric($loginField) && strlen($loginField) === 16) {
            return back()->withErrors([
                'identity' => 'Otentikasi Warga sedang dalam tahap pengembangan.'
            ])->onlyInput('identity');
        }

        // 3. Eksekusi Login Admin (Sesuai dengan seeder yang baru dibuat)
        if (Auth::guard('admin')->attempt(['email' => $loginField, 'password' => $password], $remember)) {
            // Praktik Keamanan: Mencegah serangan Session Fixation
            $request->session()->regenerate();
            
            return redirect()->intended(route('admin.dashboard'));
        }

        // TODO: Eksekusi Login Kader bisa ditambahkan di sini nantinya

        // 4. Kasus Ekstrem: Jika semua upaya login gagal
        return back()->withErrors([
            'identity' => 'Email/NIK atau Kata Sandi tidak cocok dengan data kami.',
        ])->onlyInput('identity');
    }
}