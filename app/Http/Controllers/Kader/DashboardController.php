<?php

namespace App\Http\Controllers\Kader;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Warga;
use App\Models\JadwalPosyandu;
use App\Models\PengukuranFisik;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $kader = auth('kader')->user();
        $unitId = $kader->unit_posyandu_id;

        // 1. Statistik Warga berdasarkan Unit Posyandu Kader
        $statistik = [
            'total_warga' => Warga::where('unit_posyandu_id', $unitId)->where('status', 'aktif')->count(),
            'total_balita' => Warga::where('unit_posyandu_id', $unitId)->where('status', 'aktif')->where('kategori', 'Balita')->count(),
            'total_remaja' => Warga::where('unit_posyandu_id', $unitId)->where('status', 'aktif')->where('kategori', 'Remaja')->count(),
            'total_lansia' => Warga::where('unit_posyandu_id', $unitId)->where('status', 'aktif')->where('kategori', 'Lansia')->count(),
        ];

        // 2. Jadwal Posyandu Mendatang di Unit Tersebut
        $jadwalMendatang = JadwalPosyandu::where('unit_posyandu_id', $unitId)
            ->whereDate('tanggal', '>=', Carbon::today())
            ->orderBy('tanggal', 'asc')
            ->take(3)
            ->get();

        // 3. Riwayat Pengukuran Terakhir yang dilakukan oleh Kader ini
        $pengukuranTerbaru = PengukuranFisik::with('warga')
            ->where('kader_id', $kader->id)
            ->orderBy('created_at', 'desc')
            ->take(4)
            ->get();

        return view('kader.dashboard', compact('statistik', 'jadwalMendatang', 'pengukuranTerbaru'));
    }
}