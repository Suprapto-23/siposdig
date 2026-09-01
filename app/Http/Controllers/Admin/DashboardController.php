<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kader;
use App\Models\UnitPosyandu;
use App\Models\Warga;
use Spatie\Activitylog\Models\Activity;

class DashboardController extends Controller
{
    public function index()
    {
        // Gunakan single query aggregation di mana memungkinkan
        $statistik = [
            'total_unit' => UnitPosyandu::count(),
            'kader_aktif' => Kader::where('status', 'aktif')->count(),
            'warga_aktif' => Warga::where('status', 'aktif')->count(),
            'antrean_verifikasi' => Warga::where('status', 'pending')->count(),
        ];

        // Breakdown Warga Aktif per Kategori
        $wargaPerKategori = Warga::selectRaw('kategori, count(*) as total')
            ->where('status', 'aktif')
            ->groupBy('kategori')
            ->pluck('total', 'kategori')
            ->toArray();

        // 5 Aktivitas terakhir untuk audit ringan di dashboard
        $aktivitasTerbaru = Activity::with(['causer', 'subject'])
            ->latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact('statistik', 'wargaPerKategori', 'aktivitasTerbaru'));
    }
}