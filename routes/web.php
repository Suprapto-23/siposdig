<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| IMPORT CONTROLLERS
|--------------------------------------------------------------------------
*/
// Auth
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

// Admin Controllers
use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\Admin\KaderController as AdminKader;
use App\Http\Controllers\Admin\WargaController as AdminWarga;
use App\Http\Controllers\Admin\VerifikasiAkunController;
use App\Http\Controllers\Admin\UnitPosyanduController;
use App\Http\Controllers\Admin\EdukasiKesehatanController as AdminEdukasi;
use App\Http\Controllers\Admin\LogAktivitasController;
use App\Http\Controllers\Admin\PengaturanController;

// Kader Controllers
use App\Http\Controllers\Kader\DashboardController as KaderDashboard;
use App\Http\Controllers\Kader\AbsensiController as KaderAbsensi;
use App\Http\Controllers\Kader\PengukuranFisikController as KaderPengukuran;
use App\Http\Controllers\Kader\WargaController as KaderWarga;
use App\Http\Controllers\Kader\LaporanController as KaderLaporan;

// Warga Controllers
use App\Http\Controllers\Warga\DashboardController as WargaDashboard;
use App\Http\Controllers\Warga\RiwayatPengukuranController as WargaRiwayat;
use App\Http\Controllers\Warga\EdukasiController as WargaEdukasi;
use App\Http\Controllers\Warga\ProfilController as WargaProfil;

/*
|--------------------------------------------------------------------------
| GUEST & AUTHENTICATION ROUTES
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    if (auth('admin')->check()) return redirect()->route('admin.dashboard');
    if (auth('kader')->check()) return redirect()->route('kader.dashboard');
    if (auth('warga')->check()) return redirect()->route('warga.dashboard');
    
    return view('auth.splash');
})->name('home');

Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('login.submit');
    
    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register'])->name('register.store');
    Route::get('/register/success', [RegisterController::class, 'success'])->name('register.success');
});

// Logout Global
Route::post('/logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth:admin,kader,warga');

/*
|--------------------------------------------------------------------------
| ADMIN ROUTES
|--------------------------------------------------------------------------
*/
Route::middleware(['auth:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboard::class, 'index'])->name('dashboard');
    
    Route::prefix('verifikasi')->name('verifikasi.')->group(function () {
        Route::get('/', [VerifikasiAkunController::class, 'index'])->name('index');
        Route::post('/{warga}/setujui', [VerifikasiAkunController::class, 'setujui'])->name('setujui');
        Route::post('/{warga}/tolak', [VerifikasiAkunController::class, 'tolak'])->name('tolak');
    });

    Route::resource('unit-posyandu', UnitPosyanduController::class)->except(['show']);
    
    Route::resource('kader', AdminKader::class);
    Route::post('/kader/{kader}/reset-password', [AdminKader::class, 'resetPassword'])->name('kader.reset-password');

    Route::resource('warga', AdminWarga::class); 
    Route::post('/warga/{warga}/reset-password', [AdminWarga::class, 'resetPassword'])->name('warga.reset-password');

    Route::resource('edukasi', AdminEdukasi::class);
    
    Route::get('/log-aktivitas', [LogAktivitasController::class, 'index'])->name('log-aktivitas.index');
    
    Route::get('/pengaturan', [PengaturanController::class, 'index'])->name('pengaturan.index');
    Route::post('/pengaturan', [PengaturanController::class, 'update'])->name('pengaturan.update');
});

/*
|--------------------------------------------------------------------------
| KADER ROUTES
|--------------------------------------------------------------------------
*/
Route::middleware('auth:kader')->prefix('kader')->name('kader.')->group(function () {
    Route::get('/dashboard', [KaderDashboard::class, 'index'])->name('dashboard');
    
    Route::prefix('absensi')->name('absensi.')->group(function () {
        Route::get('/success', [KaderAbsensi::class, 'success'])->name('success');
        Route::get('/detail/{tanggal}', [KaderAbsensi::class, 'detailTanggal'])->name('detail');
    });
    Route::resource('absensi', KaderAbsensi::class);
    
    Route::resource('pengukuran', KaderPengukuran::class);
    
    // Memperbaiki pemanggilan Controller Warga untuk Kader
    Route::resource('warga', KaderWarga::class);
    
    Route::prefix('laporan')->name('laporan.')->group(function () {
        Route::get('/', [KaderLaporan::class, 'index'])->name('index');
        Route::get('/cetak', [KaderLaporan::class, 'export'])->name('cetak');
    });
});

/*
|--------------------------------------------------------------------------
| WARGA ROUTES
|--------------------------------------------------------------------------
*/
Route::middleware(['auth:warga'])->prefix('warga')->name('warga.')->group(function () {
    Route::get('/dashboard', [WargaDashboard::class, 'index'])->name('dashboard');
    
    Route::prefix('riwayat')->name('riwayat.')->group(function () {
        Route::get('/', [WargaRiwayat::class, 'index'])->name('index');
        // Opsi jika kedepannya ada detail riwayat per ID
        Route::get('/{id}', [WargaRiwayat::class, 'show'])->name('show');
    });
    
    Route::prefix('edukasi')->name('edukasi.')->group(function () {
        Route::get('/', [WargaEdukasi::class, 'index'])->name('index');
        Route::get('/{slug}', [WargaEdukasi::class, 'show'])->name('show');
    });

    Route::prefix('profil')->name('profil.')->group(function () {
        Route::get('/', [WargaProfil::class, 'index'])->name('index');
        Route::put('/update', [WargaProfil::class, 'updateProfil'])->name('update');
        Route::put('/password', [WargaProfil::class, 'updatePassword'])->name('password');
    });
});