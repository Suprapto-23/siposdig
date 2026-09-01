<?php

namespace App\Http\Controllers\Warga;

use App\Http\Controllers\Controller;
use App\Models\PengukuranFisik;
use App\Models\EdukasiKesehatan;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $warga = auth('warga')->user();

        // Mengambil data pengukuran fisik paling terakhir
        $pengukuranTerakhir = PengukuranFisik::where('warga_id', $warga->id)
                                ->orderBy('tanggal_ukur', 'desc')
                                ->first();

        // Mengambil 3 artikel edukasi kesehatan terbaru
        $edukasiTerbaru = EdukasiKesehatan::orderBy('created_at', 'desc')->take(3)->get();

        return view('warga.dashboard', compact('warga', 'pengukuranTerakhir', 'edukasiTerbaru'));
    }
}