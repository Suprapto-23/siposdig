<?php

namespace App\Http\Controllers\Kader;

use App\Http\Controllers\Controller;
use App\Models\Warga;
use App\Models\Absensi;
use App\Models\PengukuranFisik;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $kaderUnitId = auth('kader')->user()->unit_posyandu_id;
        
        $bulan = $request->input('bulan', now()->format('m'));
        $tahun = $request->input('tahun', now()->format('Y'));
        $kategori = $request->input('kategori', 'Semua');

        // 1. Statistik Demografi Warga Aktif
        $totalWarga  = Warga::where('unit_posyandu_id', $kaderUnitId)->where('status', 'aktif')->count();
        $wargaBalita = Warga::where('unit_posyandu_id', $kaderUnitId)->where('status', 'aktif')->where('kategori', 'Balita')->count();
        $wargaRemaja = Warga::where('unit_posyandu_id', $kaderUnitId)->where('status', 'aktif')->where('kategori', 'Remaja')->count();
        $wargaLansia = Warga::where('unit_posyandu_id', $kaderUnitId)->where('status', 'aktif')->where('kategori', 'Lansia')->count();

        // 2. Rekapitulasi Absensi Bulanan
        $rekapAbsensi = Absensi::where('unit_posyandu_id', $kaderUnitId)
            ->whereMonth('tanggal', $bulan)
            ->whereYear('tanggal', $tahun)
            ->selectRaw('status_hadir, COUNT(*) as total')
            ->groupBy('status_hadir')
            ->pluck('total', 'status_hadir');

        $totalHadir = $rekapAbsensi['hadir'] ?? 0;
        $totalIzin  = $rekapAbsensi['izin'] ?? 0;
        $totalSakit = $rekapAbsensi['sakit'] ?? 0;

        // 3. Tarik data pengukuran fisik
        $queryPengukuran = PengukuranFisik::with('warga')
            ->whereHas('warga', function($q) use ($kaderUnitId, $kategori) {
                $q->where('unit_posyandu_id', $kaderUnitId);
                if ($kategori !== 'Semua') {
                    $q->where('kategori', $kategori);
                }
            })
            ->whereMonth('tanggal_ukur', $bulan)
            ->whereYear('tanggal_ukur', $tahun);

        $dataLaporan = (clone $queryPengukuran)->orderBy('tanggal_ukur', 'desc')->get();
        $totalPengukuran = (clone $queryPengukuran)->count();

        // 4. Indikator Status Stunting Balita Bulanan
        $dataStunting = PengukuranFisik::whereHas('warga', function($q) use ($kaderUnitId) {
                $q->where('unit_posyandu_id', $kaderUnitId)->where('kategori', 'Balita');
            })
            ->whereMonth('tanggal_ukur', $bulan)
            ->whereYear('tanggal_ukur', $tahun)
            ->selectRaw('status_stunting, COUNT(*) as total')
            ->groupBy('status_stunting')
            ->pluck('total', 'status_stunting');

        // 5. Summary Cards
        $summary = [
            'total_diukur' => $dataLaporan->count(),
            'rata_berat'   => $dataLaporan->avg('berat_badan') ? round($dataLaporan->avg('berat_badan'), 2) : 0,
            'rata_tinggi'  => $dataLaporan->avg('tinggi_badan') ? round($dataLaporan->avg('tinggi_badan'), 2) : 0,
        ];

        return view('kader.laporan.index', compact(
            'dataLaporan', 'bulan', 'tahun', 'kategori', 'summary',
            'totalWarga', 'wargaBalita', 'wargaRemaja', 'wargaLansia',
            'totalHadir', 'totalIzin', 'totalSakit', 'totalPengukuran',
            'dataStunting'
        ));
    }

    // Fungsi Pengaman agar tidak error jika ada rute show terpanggil
    public function show($id)
    {
        return redirect()->route('kader.laporan.index');
    }

    // Fungsi Cetak Laporan
    public function export(Request $request)
    {
        $kaderUnitId = auth('kader')->user()->unit_posyandu_id;
        $bulan = $request->input('bulan', now()->format('m'));
        $tahun = $request->input('tahun', now()->format('Y'));
        $kategori = $request->input('kategori', 'Semua');

        $query = PengukuranFisik::with(['warga', 'kader'])
            ->whereHas('warga', function($q) use ($kaderUnitId, $kategori) {
                $q->where('unit_posyandu_id', $kaderUnitId);
                if ($kategori !== 'Semua') {
                    $q->where('kategori', $kategori);
                }
            })
            ->whereMonth('tanggal_ukur', $bulan)
            ->whereYear('tanggal_ukur', $tahun);

        $dataLaporan = $query->orderBy('tanggal_ukur', 'asc')->get();

        return view('kader.laporan.cetak', compact('dataLaporan', 'bulan', 'tahun', 'kategori'));
    }
}