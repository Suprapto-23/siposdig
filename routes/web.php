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
use App\Http\Controllers\Kader\DashboardController as KaderDashboardController;
use App\Http\Controllers\Kader\AbsensiController;
use App\Http\Controllers\Kader\PengukuranFisikController;
use App\Http\Controllers\Kader\WargaController as KaderWargaController;
use App\Http\Controllers\Kader\LaporanController;

// Warga Controllers
use App\Http\Controllers\Warga\DashboardController as WargaDashboard;
use App\Http\Controllers\Warga\RiwayatPengukuranController;
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
    
    Route::get('/verifikasi', [VerifikasiAkunController::class, 'index'])->name('verifikasi.index');
    Route::post('/verifikasi/{warga}/setujui', [VerifikasiAkunController::class, 'setujui'])->name('verifikasi.setujui');
    Route::post('/verifikasi/{warga}/tolak', [VerifikasiAkunController::class, 'tolak'])->name('verifikasi.tolak');

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
    Route::get('/dashboard', [KaderDashboardController::class, 'index'])->name('dashboard');
    
    Route::get('/absensi/success', [App\Http\Controllers\Kader\AbsensiController::class, 'success'])->name('absensi.success');
    Route::get('/absensi/detail/{tanggal}', [App\Http\Controllers\Kader\AbsensiController::class, 'detailTanggal'])->name('absensi.detail');
    Route::resource('absensi', App\Http\Controllers\Kader\AbsensiController::class);
    Route::resource('pengukuran', PengukuranFisikController::class);
    Route::resource('warga', AdminWarga::class);
    
    // PERBAIKAN: Cukup gunakan 'laporan.index' karena sudah berada di dalam group name('kader.')
    Route::get('/laporan', [App\Http\Controllers\Kader\LaporanController::class, 'index'])->name('laporan.index');
    Route::get('/laporan/cetak', [App\Http\Controllers\Kader\LaporanController::class, 'export'])->name('laporan.cetak');
});


/*
|--------------------------------------------------------------------------
| WARGA ROUTES
|--------------------------------------------------------------------------
*/
Route::middleware(['auth:warga'])->prefix('warga')->name('warga.')->group(function () {
    Route::get('/dashboard', [WargaDashboard::class, 'index'])->name('dashboard');
    Route::get('/riwayat', [RiwayatPengukuranController::class, 'index'])->name('riwayat.index');
    
    Route::get('/edukasi', [WargaEdukasi::class, 'index'])->name('edukasi.index');
    Route::get('/edukasi/{slug}', [WargaEdukasi::class, 'show'])->name('edukasi.show');

    Route::get('/profil', [WargaProfil::class, 'index'])->name('profil.index');
    Route::put('/profil', [WargaProfil::class, 'updateProfil'])->name('profil.update');
    Route::put('/profil/password', [WargaProfil::class, 'updatePassword'])->name('profil.password');
});