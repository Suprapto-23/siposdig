<?php

namespace App\Http\Controllers\Kader;

use App\Http\Controllers\Controller;
use App\Models\Warga;
use App\Models\Absensi;
use App\Models\PengukuranFisik;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf; // Import DOMPDF

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $kaderUnitId = auth('kader')->user()->unit_posyandu_id;
        
        $bulan = $request->input('bulan', now()->format('m'));
        $tahun = $request->input('tahun', now()->format('Y'));
        $kategori = $request->input('kategori', 'Semua');

        // 1. Statistik Warga Aktif
        $totalWarga  = Warga::where('unit_posyandu_id', $kaderUnitId)->where('status', 'aktif')->count();
        $wargaBalita = Warga::where('unit_posyandu_id', $kaderUnitId)->where('status', 'aktif')->where('kategori', 'Balita')->count();
        $wargaRemaja = Warga::where('unit_posyandu_id', $kaderUnitId)->where('status', 'aktif')->where('kategori', 'Remaja')->count();
        $wargaLansia = Warga::where('unit_posyandu_id', $kaderUnitId)->where('status', 'aktif')->where('kategori', 'Lansia')->count();

        // 2. Tarik Data Pengukuran Berdasarkan Filter
        $queryPengukuran = PengukuranFisik::with('warga')
            ->whereHas('warga', function($q) use ($kaderUnitId, $kategori) {
                $q->where('unit_posyandu_id', $kaderUnitId);
                if ($kategori !== 'Semua') $q->where('kategori', $kategori);
            })
            ->whereMonth('tanggal_ukur', $bulan)
            ->whereYear('tanggal_ukur', $tahun);

        $dataLaporan = (clone $queryPengukuran)->orderBy('tanggal_ukur', 'desc')->get();
        
        // Proteksi Bug: Mencegah nilai Null saat data kosong
        $avgBb = $dataLaporan->avg('berat_badan');
        $avgTb = $dataLaporan->avg('tinggi_badan');

        $summary = [
            'total_diukur' => $dataLaporan->count(),
            'rata_berat'   => $avgBb ? round($avgBb, 2) : 0,
            'rata_tinggi'  => $avgTb ? round($avgTb, 2) : 0,
        ];

        return view('kader.laporan.index', compact(
            'dataLaporan', 'bulan', 'tahun', 'kategori', 'summary',
            'totalWarga', 'wargaBalita', 'wargaRemaja', 'wargaLansia'
        ));
    }

    public function export(Request $request)
    {
        $kaderUnitId = auth('kader')->user()->unit_posyandu_id;
        $bulan = $request->input('bulan', now()->format('m'));
        $tahun = $request->input('tahun', now()->format('Y'));
        $kategori = $request->input('kategori', 'Semua');

        $dataLaporan = PengukuranFisik::with(['warga', 'kader'])
            ->whereHas('warga', function($q) use ($kaderUnitId, $kategori) {
                $q->where('unit_posyandu_id', $kaderUnitId);
                if ($kategori !== 'Semua') $q->where('kategori', $kategori);
            })
            ->whereMonth('tanggal_ukur', $bulan)
            ->whereYear('tanggal_ukur', $tahun)
            ->orderBy('tanggal_ukur', 'asc')
            ->get();

        // Generate PDF menggunakan DOMPDF (Kertas Landscape)
        $pdf = Pdf::loadView('kader.laporan.cetak', compact('dataLaporan', 'bulan', 'tahun', 'kategori'))
                  ->setPaper('a4', 'landscape');
        
        $namaFile = "Laporan_Posyandu_{$kategori}_{$bulan}_{$tahun}.pdf";

        // Mengembalikan response DOWNLOAD langsung, tanpa pindah halaman
        return $pdf->download($namaFile);
    }
}