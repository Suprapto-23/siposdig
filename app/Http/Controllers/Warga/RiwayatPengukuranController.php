<?php

namespace App\Http\Controllers\Warga;

use App\Http\Controllers\Controller;
use App\Models\PengukuranFisik;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RiwayatPengukuranController extends Controller
{
    public function index()
    {
        // Ambil data warga yang sedang login
        $warga = Auth::guard('warga')->user();

        // Ambil riwayat pengukuran fisik khusus untuk warga ini
        // Diurutkan dari tanggal terbaru, dibatasi 10 data per halaman
        $riwayat = PengukuranFisik::where('warga_id', $warga->id)
            ->orderBy('tanggal_ukur', 'desc')
            ->paginate(10);

        return view('warga.riwayat.index', compact('warga', 'riwayat'));
    }
}