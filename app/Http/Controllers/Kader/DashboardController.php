<?php

namespace App\Http\Controllers\Kader;

use App\Http\Controllers\Controller;
use App\Models\JadwalPosyandu;
use App\Models\PengukuranFisik;
use App\Models\Warga;
use Illuminate\Support\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $kader = auth('kader')->user();
        $unitId = $kader->unit_posyandu_id;
        $bulanIni = Carbon::now()->format('m');
        $tahunIni = Carbon::now()->format('Y');

        // 1. Statistik Warga Binaan
        $totalWarga = Warga::where('unit_posyandu_id', $unitId)
            ->where('status', 'aktif')
            ->count();
        
        // 2. Warga yang sudah diukur bulan ini
        $wargaDiukurBulanIni = PengukuranFisik::whereHas('warga', function($q) use ($unitId) {
            $q->where('unit_posyandu_id', $unitId);
        })
        ->whereMonth('tanggal_ukur', $bulanIni)
        ->whereYear('tanggal_ukur', $tahunIni)
        ->distinct('warga_id')
        ->count('warga_id');

        $belumDiukur = max(0, $totalWarga - $wargaDiukurBulanIni);

        // 3. Aktivitas Pengukuran Terakhir (Limit 5)
        $pengukuranTerbaru = PengukuranFisik::with('warga:id,nama,kategori,nik')
            ->whereHas('warga', function($q) use ($unitId) {
                $q->where('unit_posyandu_id', $unitId);
            })
            ->latest('tanggal_ukur')
            ->take(5)
            ->get();

        // 4. Ambil jadwal terdekat untuk unit ini (hari ini atau di masa depan)
        $jadwalTerdekat = JadwalPosyandu::where('unit_posyandu_id', $unitId)
            ->whereDate('tanggal', '>=', Carbon::today())
            ->orderBy('tanggal', 'asc')
            ->first();

        return view('kader.dashboard', compact(
            'totalWarga', 
            'wargaDiukurBulanIni', 
            'belumDiukur', 
            'pengukuranTerbaru',
            'jadwalTerdekat'
        ));
    }
}