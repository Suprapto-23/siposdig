<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JadwalPosyandu;
use App\Models\Kader;
use App\Models\UnitPosyandu;
use App\Models\Warga;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $totalUnit = UnitPosyandu::where('status', 'aktif')->count();
        $totalKader = Kader::where('status', 'aktif')->count();
        $totalWarga = Warga::where('status', 'aktif')->count();

        // Batas usia kategori (sementara hardcode, nanti dipindah ke tabel `pengaturan`)
        $totalBalita = Warga::where('status', 'aktif')
            ->whereRaw('TIMESTAMPDIFF(MONTH, tanggal_lahir, CURDATE()) <= 59')
            ->count();
        $totalRemaja = Warga::where('status', 'aktif')
            ->whereRaw('TIMESTAMPDIFF(YEAR, tanggal_lahir, CURDATE()) BETWEEN 6 AND 17')
            ->count();
        $totalLansia = Warga::where('status', 'aktif')
            ->whereRaw('TIMESTAMPDIFF(YEAR, tanggal_lahir, CURDATE()) >= 60')
            ->count();

        $antreanVerifikasi = Warga::where('status', 'pending')->count();
        $antreanTerbaru = Warga::with('unitPosyandu')
            ->where('status', 'pending')
            ->latest()
            ->take(4)
            ->get();

        $jadwalMendatang = JadwalPosyandu::with('unitPosyandu')
            ->whereDate('tanggal', '>=', now())
            ->orderBy('tanggal')
            ->take(3)
            ->get();

        return view('admin.dashboard', compact(
            'totalUnit', 'totalKader', 'totalWarga',
            'totalBalita', 'totalRemaja', 'totalLansia',
            'antreanVerifikasi', 'antreanTerbaru', 'jadwalMendatang'
        ));
    }
}