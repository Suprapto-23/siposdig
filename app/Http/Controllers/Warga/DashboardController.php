<?php

namespace App\Http\Controllers\Warga;

use App\Http\Controllers\Controller;
use App\Models\EdukasiKesehatan;
use App\Models\PengukuranFisik;
use App\Models\SaranKader;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $warga = auth('warga')->user();

        // 1. Ambil Pengukuran Terakhir untuk ringkasan status saat ini
        $pengukuranTerakhir = PengukuranFisik::where('warga_id', $warga->id)
            ->latest('tanggal_ukur')
            ->first();

        // 2. Ambil 6 Riwayat Terakhir untuk disuntikkan ke JavaScript (Chart.js / Alpine) di view
        $grafikPertumbuhan = PengukuranFisik::where('warga_id', $warga->id)
            ->orderBy('tanggal_ukur', 'asc') // Ascending untuk grafik dari kiri ke kanan
            ->take(6)
            ->get(['tanggal_ukur', 'berat_badan', 'tinggi_badan', 'tekanan_darah_sistol', 'tekanan_darah_diastol', 'imt']);

        // 3. Pesan/Saran terbaru dari Kader
        $saranTerbaru = SaranKader::with('kader:id,nama')
            ->where('warga_id', $warga->id)
            ->latest('tanggal')
            ->take(3)
            ->get();

        // 4. Rekomendasi Artikel (Sesuai kategori)
        $artikelRekomendasi = EdukasiKesehatan::where('status', 'publish')
            ->whereIn('target_kategori', [$warga->kategori, 'Semua'])
            ->inRandomOrder()
            ->take(2)
            ->get();

        return view('warga.dashboard', compact(
            'warga', 
            'pengukuranTerakhir', 
            'grafikPertumbuhan', 
            'saranTerbaru', 
            'artikelRekomendasi'
        ));
    }
}