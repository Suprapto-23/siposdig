<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

// Import Admin Controllers
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\VerifikasiAkunController;
use App\Http\Controllers\Admin\KaderController; // <-- Ini yang kurang sebelumnya
use App\Http\Controllers\Admin\WargaController;
use App\Http\Controllers\Admin\UnitPosyanduController;
use App\Http\Controllers\Admin\EdukasiKesehatanController;
use App\Http\Controllers\Admin\LogAktivitasController;
use App\Http\Controllers\Admin\PengaturanController;

// Import Kader & Warga Controllers
use App\Http\Controllers\Kader\DashboardController as KaderDashboardController;
use App\Http\Controllers\Warga\DashboardController as WargaDashboardController;

/*
|--------------------------------------------------------------------------
| Root
|--------------------------------------------------------------------------
*/

Route::get('/', fn () => view('auth.splash'))->name('splash');

/*
|--------------------------------------------------------------------------
| Auth (Login + Registrasi Warga)
|--------------------------------------------------------------------------
*/

Route::get('/login', [LoginController::class, 'create'])->name('login');
Route::post('/login', [LoginController::class, 'store']);

Route::get('/register', [RegisterController::class, 'create'])->name('register');
Route::post('/register', [RegisterController::class, 'store'])->name('register.store');
Route::get('/register/sukses', [RegisterController::class, 'success'])->name('register.success');

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| Admin (guard: admin)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    
    // Verifikasi
    Route::get('/verifikasi', [VerifikasiAkunController::class, 'index'])->name('verifikasi');
    Route::patch('/verifikasi/{id}/approve', [VerifikasiAkunController::class, 'approve'])->name('verifikasi.approve');
    Route::patch('/verifikasi/{id}/reject', [VerifikasiAkunController::class, 'reject'])->name('verifikasi.reject');

    // Kelola Kader
    Route::resource('kader', KaderController::class)->except(['show']);

    // Rute CRUD Warga
    Route::resource('warga', WargaController::class);

    // Unit Posyandu
    Route::resource('unit-posyandu', UnitPosyanduController::class);

    // Rute Edukasi Kesehatan
    Route::resource('edukasi', EdukasiKesehatanController::class);
    
    // Menu Lainnya
    Route::get('/log-aktivitas', [LogAktivitasController::class, 'index'])->name('log-aktivitas');
Route::delete('/log-aktivitas/clear', [LogAktivitasController::class, 'clear'])->name('log-aktivitas.clear');

    Route::get('/pengaturan', [PengaturanController::class, 'index'])->name('pengaturan');
});

/*
|--------------------------------------------------------------------------
| Kader (guard: kader)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth:kader'])->prefix('kader')->name('kader.')->group(function () {
    Route::get('/dashboard', [KaderDashboardController::class, 'index'])->name('dashboard');
});

/*
|--------------------------------------------------------------------------
| Warga (guard: warga)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth:warga'])->prefix('warga')->name('warga.')->group(function () {
    Route::get('/dashboard', [WargaDashboardController::class, 'index'])->name('dashboard');
});