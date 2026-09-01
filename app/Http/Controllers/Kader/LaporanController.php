<?php

namespace App\Http\Controllers\Kader;

use App\Http\Controllers\Controller;
use App\Models\PengukuranFisik;
use Illuminate\Http\Request;
use Carbon\Carbon;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $kaderUnitId = auth('kader')->user()->unit_posyandu_id;
        
        $bulan = $request->input('bulan', now()->format('m'));
        $tahun = $request->input('tahun', now()->format('Y'));
        $kategori = $request->input('kategori', 'Balita');

        // Tarik data pengukuran beserta relasi warganya, filter by bulan & tahun
        $dataLaporan = PengukuranFisik::with('warga')
            ->whereHas('warga', function($q) use ($kaderUnitId, $kategori) {
                $q->where('unit_posyandu_id', $kaderUnitId)
                  ->where('kategori', $kategori);
            })
            ->whereMonth('tanggal_ukur', $bulan)
            ->whereYear('tanggal_ukur', $tahun)
            ->orderBy('tanggal_ukur', 'desc')
            ->get();

        // Agregasi Cepat untuk Summary Cards di atas tabel laporan
        $summary = [
            'total_diukur' => $dataLaporan->count(),
            'rata_berat' => $dataLaporan->avg('berat_badan') ? round($dataLaporan->avg('berat_badan'), 2) : 0,
            'rata_tinggi' => $dataLaporan->avg('tinggi_badan') ? round($dataLaporan->avg('tinggi_badan'), 2) : 0,
        ];

        return view('kader.laporan.index', compact('dataLaporan', 'bulan', 'tahun', 'kategori', 'summary'));
    }

    // Inisiatif: Siapkan struktur untuk export. View 'kader.laporan.pdf' bisa didesain khusus print (hitam putih/tanpa navbar)
    public function export(Request $request)
    {
        $kaderUnitId = auth('kader')->user()->unit_posyandu_id;
        $bulan = $request->input('bulan', now()->format('m'));
        $tahun = $request->input('tahun', now()->format('Y'));
        
        $data = PengukuranFisik::with('warga')
            ->whereHas('warga', function($q) use ($kaderUnitId) {
                $q->where('unit_posyandu_id', $kaderUnitId);
            })
            ->whereMonth('tanggal_ukur', $bulan)
            ->whereYear('tanggal_ukur', $tahun)
            ->get();

        // Jika pakai barryvdh/laravel-dompdf:
        // $pdf = \PDF::loadView('kader.laporan.pdf', compact('data', 'bulan', 'tahun'));
        // return $pdf->download("Laporan_Posyandu_{$bulan}_{$tahun}.pdf");
        
        // Fallback sementara cetak HTML native
        return view('kader.laporan.cetak', compact('data', 'bulan', 'tahun'));
    }
}