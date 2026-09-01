<?php

namespace App\Http\Controllers\Kader;

use App\Http\Controllers\Controller;
use App\Models\Absensi;
use App\Models\Warga;
use Illuminate\Http\Request;

class AbsensiController extends Controller
{
    // 1. HALAMAN INDEX: Group by Tanggal & Kategori
    public function index(Request $request)
    {
        $kader = auth('kader')->user();
        
        $query = Absensi::join('warga', 'absensi.warga_id', '=', 'warga.id')
            ->where('absensi.unit_posyandu_id', $kader->unit_posyandu_id)
            ->selectRaw('
                absensi.tanggal,
                warga.kategori,
                COUNT(absensi.id) as total_sasaran,
                SUM(CASE WHEN absensi.status_hadir = "hadir" THEN 1 ELSE 0 END) as total_hadir,
                SUM(CASE WHEN absensi.status_hadir = "izin" THEN 1 ELSE 0 END) as total_izin,
                SUM(CASE WHEN absensi.status_hadir = "sakit" THEN 1 ELSE 0 END) as total_sakit
            ')
            ->groupBy('absensi.tanggal', 'warga.kategori')
            ->orderBy('absensi.tanggal', 'desc');

        // Filter Pencarian Tanggal
        if ($request->has('search') && $request->search != '') {
            $query->where('absensi.tanggal', 'like', "%{$request->search}%");
        }

        // Filter Dropdown Kategori
        if ($request->has('kategori') && in_array($request->kategori, ['Balita', 'Remaja', 'Lansia'])) {
            $query->where('warga.kategori', $request->kategori);
        }

        $riwayatTanggal = $query->paginate(10)->withQueryString();

        return view('kader.absensi.index', compact('riwayatTanggal'));
    }

    // 2. HALAMAN SHOW: Detail per Tanggal dan Kategori
    public function detailTanggal($tanggal, Request $request)
    {
        $kader = auth('kader')->user();
        $kategori = $request->kategori ?? 'Balita'; // Wajib menerima parameter kategori dari Index
        
        $queryBase = Absensi::with(['warga', 'kader'])
            ->where('absensi.unit_posyandu_id', $kader->unit_posyandu_id)
            ->where('absensi.tanggal', $tanggal)
            ->whereHas('warga', function($q) use ($kategori) {
                $q->where('kategori', $kategori);
            });

        // Hitung Statistik Instan untuk Header Show Blade
        $statistik = [
            'total' => (clone $queryBase)->count(),
            'hadir' => (clone $queryBase)->where('status_hadir', 'hadir')->count(),
            'tidak_hadir' => (clone $queryBase)->whereIn('status_hadir', ['izin', 'sakit'])->count(),
        ];

        // Filter Pencarian di dalam Detail
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $queryBase->whereHas('warga', function($q) use ($search) {
                $q->where('nama_lengkap', 'like', "%{$search}%")
                  ->orWhere('nik', 'like', "%{$search}%");
            });
        }

        $absensi = $queryBase->orderBy('status_hadir', 'asc')->paginate(15)->withQueryString();

        return view('kader.absensi.show', compact('absensi', 'tanggal', 'kategori', 'statistik'));
    }

    // (Fungsi create, store, dan success JANGAN DIUBAH, biarkan seperti semula)
    public function create(Request $request) { /*...*/ }
    public function store(Request $request) { /*...*/ }
    public function success() { /*...*/ }
}