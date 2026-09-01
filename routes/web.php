<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| IMPORT CONTROLLERS (DENGAN ALIAS UNTUK MENCEGAH BENTROK)
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
use App\Http\Controllers\Kader\WargaController as KaderWarga;
use App\Http\Controllers\Kader\PengukuranFisikController;
use App\Http\Controllers\Kader\AbsensiController;
use App\Http\Controllers\Kader\SaranController;
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
    return view('welcome');
})->name('home');

Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('login.submit');
    
    // Registrasi Warga Mandiri (Ubah name menjadi register.store)
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
    // Dashboard Utama
    Route::get('/dashboard', [AdminDashboard::class, 'index'])->name('dashboard');

    // Modul Verifikasi Pendaftaran Warga
    Route::get('/verifikasi', [VerifikasiAkunController::class, 'index'])->name('verifikasi.index');
    Route::post('/verifikasi/{warga}/setujui', [VerifikasiAkunController::class, 'setujui'])->name('verifikasi.setujui');
    Route::post('/verifikasi/{warga}/tolak', [VerifikasiAkunController::class, 'tolak'])->name('verifikasi.tolak');

    // Modul Master Unit Posyandu
    Route::resource('unit', UnitPosyanduController::class)->except(['create', 'show', 'edit']); // Pakai modal untuk create/edit

    // Modul Pengelolaan Kader
    Route::resource('kader', AdminKader::class);
    Route::post('/kader/{kader}/reset-password', [AdminKader::class, 'resetPassword'])->name('kader.reset-password');

    // Modul Pengelolaan Warga (Global)
    Route::resource('warga', AdminWarga::class)->except(['store']); // Warga ditambah via register/verifikasi
    Route::post('/warga/{warga}/reset-password', [AdminWarga::class, 'resetPassword'])->name('warga.reset-password');

    // Modul Edukasi Kesehatan (CMS)
    Route::resource('edukasi', AdminEdukasi::class);

    // Modul Audit Trail (Log)
    Route::get('/log-aktivitas', [LogAktivitasController::class, 'index'])->name('log-aktivitas.index');

    // Modul Pengaturan Sistem
    Route::get('/pengaturan', [PengaturanController::class, 'index'])->name('pengaturan.index');
    Route::post('/pengaturan', [PengaturanController::class, 'update'])->name('pengaturan.update');
});


/*
|--------------------------------------------------------------------------
| KADER ROUTES
|--------------------------------------------------------------------------
*/
Route::middleware(['auth:kader'])->prefix('kader')->name('kader.')->group(function () {
    // Dashboard Kader
    Route::get('/dashboard', [KaderDashboard::class, 'index'])->name('dashboard');

    // Modul Absensi (Terikat Jadwal)
    Route::get('/absensi', [AbsensiController::class, 'index'])->name('absensi.index');
    Route::get('/absensi/{jadwalId}/isi', [AbsensiController::class, 'create'])->name('absensi.create');
    Route::post('/absensi/{jadwalId}', [AbsensiController::class, 'store'])->name('absensi.store');

    // Modul Warga Binaan (Hanya Warga di Unit Kader terkait)
    Route::resource('warga', KaderWarga::class)->except(['destroy']);

    // Modul Pengukuran Fisik Dinamis
    Route::resource('pengukuran', PengukuranFisikController::class);

    // Modul Saran/Catatan Kesehatan Khusus Warga
    Route::post('/saran', [SaranController::class, 'store'])->name('saran.store');
    Route::delete('/saran/{id}', [SaranController::class, 'destroy'])->name('saran.destroy');

    // Modul Rekapitulasi Laporan (Eskpor PDF/Excel)
    Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
    Route::get('/laporan/cetak', [LaporanController::class, 'export'])->name('laporan.cetak');
    Route::post('/laporan/import', [LaporanController::class, 'import'])->name('laporan.import'); // Jika ada migrasi Excel
});


/*
|--------------------------------------------------------------------------
| WARGA ROUTES
|--------------------------------------------------------------------------
*/
Route::middleware(['auth:warga'])->prefix('warga')->name('warga.')->group(function () {
    // Dashboard Warga (Adaptif sesuai umur)
    Route::get('/dashboard', [WargaDashboard::class, 'index'])->name('dashboard');

    // Riwayat Pertumbuhan & Kesehatan
    Route::get('/riwayat', [RiwayatPengukuranController::class, 'index'])->name('riwayat.index');

    // Perpustakaan Edukasi Kesehatan
    Route::get('/edukasi', [WargaEdukasi::class, 'index'])->name('edukasi.index');
    Route::get('/edukasi/{slug}', [WargaEdukasi::class, 'show'])->name('edukasi.show');

    // Profil & Pengaturan Akun (Termasuk Reset Password Login Pertama)
    Route::get('/profil', [WargaProfil::class, 'index'])->name('profil.index');
    Route::put('/profil', [WargaProfil::class, 'updateProfil'])->name('profil.update');
    Route::put('/profil/password', [WargaProfil::class, 'updatePassword'])->name('profil.password');
});