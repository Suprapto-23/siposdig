<?php

namespace App\Http\Controllers\Warga;

use App\Http\Controllers\Controller;
use App\Models\PengukuranFisik;
use App\Models\JadwalPosyandu;
use App\Models\EdukasiKesehatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $warga = Auth::guard('warga')->user();

        // 1. Ambil data pengukuran fisik terakhir (jika ada)
        $pengukuranTerakhir = PengukuranFisik::where('warga_id', $warga->id)
            ->latest('tanggal_ukur')
            ->first();

        // 2. Ambil jadwal posyandu terdekat di unit warga tersebut
        // Proaktif: Memastikan hanya jadwal hari ini atau ke depan yang ditampilkan
        $jadwalMendatang = JadwalPosyandu::where('unit_posyandu_id', $warga->unit_posyandu_id)
            ->whereDate('tanggal', '>=', Carbon::today())
            ->orderBy('tanggal', 'asc')
            ->first();

        // 3. Ambil 3 artikel edukasi kesehatan terbaru untuk slider/list
        $edukasiTerbaru = EdukasiKesehatan::latest()->take(3)->get();

        return view('warga.dashboard', compact('warga', 'pengukuranTerakhir', 'jadwalMendatang', 'edukasiTerbaru'));
    }
}