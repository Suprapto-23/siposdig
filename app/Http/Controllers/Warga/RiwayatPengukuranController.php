<?php

namespace App\Http\Controllers\Warga;

use App\Http\Controllers\Controller;
use App\Models\PengukuranFisik;
use Illuminate\Http\Request;

class RiwayatPengukuranController extends Controller
{
    public function index(Request $request)
    {
        $wargaId = auth('warga')->id();
        $kategori = auth('warga')->user()->kategori;

        $query = PengukuranFisik::with('kader:id,nama')
            ->where('warga_id', $wargaId);

        // Filter Tahun jika Warga ingin melihat histori tahun lalu
        if ($request->filled('tahun')) {
            $query->whereYear('tanggal_ukur', $request->tahun);
        }

        $riwayat = $query->latest('tanggal_ukur')->paginate(12); // Tampilkan per 12 bulan (1 tahun)

        return view('warga.riwayat.index', compact('riwayat', 'kategori'));
    }
}