<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Warga;
use App\Models\Kader;
use App\Models\UnitPosyandu;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // 1. Ambil Statistik Utama
        $totalWarga = Warga::where('status', '!=', 'pending')->count();
        $wargaPending = Warga::where('status', 'pending')->count();
        $totalKader = Kader::count();
        $totalPosyandu = UnitPosyandu::count();

        // 2. Ambil 5 Pendaftar Warga Terbaru (Ini yang menyebabkan error "Undefined variable $warga")
        $warga = Warga::with('unitPosyandu')->latest()->take(5)->get();

        // 3. Kirim semua variabel ke tampilan
        return view('admin.dashboard', compact(
            'totalWarga', 
            'wargaPending', 
            'totalKader', 
            'totalPosyandu', 
            'warga' // Variabel $warga kini tersedia untuk View!
        ));
    }
}