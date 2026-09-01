<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Warga;
use App\Models\Kader;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'login_id' => 'required|string',
            'password' => 'required|string',
        ]);

        $loginId = $credentials['login_id'];
        $password = $credentials['password'];
        $remember = $request->filled('remember');

        // 1. Cek apakah input adalah NIK (16 digit angka) -> Guard Warga
        if (preg_match('/^\d{16}$/', $loginId)) {
            $warga = Warga::where('nik', $loginId)->first();
            
            if ($warga) {
                if ($warga->status === 'pending') {
                    return back()->withInput()->withErrors(['login_id' => 'Akun Anda masih menunggu verifikasi dari Admin.']);
                }
                if ($warga->status === 'ditolak' || $warga->status === 'nonaktif') {
                    return back()->withInput()->withErrors(['login_id' => 'Akun Anda ditolak atau dinonaktifkan.']);
                }
            }

            if (Auth::guard('warga')->attempt(['nik' => $loginId, 'password' => $password], $remember)) {
                $request->session()->regenerate();
                return redirect()->intended(route('warga.dashboard'));
            }
        } 
        // 2. Jika berupa format email -> Cek Admin dahulu, lalu Kader
        else {
            // Coba Guard Admin
            if (Auth::guard('admin')->attempt(['email' => $loginId, 'password' => $password], $remember)) {
                $request->session()->regenerate();
                return redirect()->intended(route('admin.dashboard'));
            }

            // Coba Guard Kader
            $kader = Kader::where('email', $loginId)->first();
            if ($kader && $kader->status === 'nonaktif') {
                return back()->withInput()->withErrors(['login_id' => 'Akun Kader Anda telah dinonaktifkan.']);
            }

            if (Auth::guard('kader')->attempt(['email' => $loginId, 'password' => $password], $remember)) {
                $request->session()->regenerate();
                return redirect()->intended(route('kader.dashboard'));
            }
        }

        return back()->withInput()->withErrors([
            'login_id' => 'Kredensial atau password yang Anda masukkan tidak valid.',
        ]);
    }

    public function logout(Request $request)
    {
        if (Auth::guard('admin')->check()) {
            Auth::guard('admin')->logout();
        } elseif (Auth::guard('kader')->check()) {
            Auth::guard('kader')->logout();
        } elseif (Auth::guard('warga')->check()) {
            Auth::guard('warga')->logout();
        }

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Anda telah berhasil keluar sesi.');
    }
}