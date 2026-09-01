<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Spatie\Activitylog\Models\Activity;
use Illuminate\Http\Request;

class LogAktivitasController extends Controller
{
    public function index(Request $request)
    {
        // Menggunakan library spatie/laravel-activitylog
        // Eager load morphTo relationships untuk performa
        $logs = Activity::with(['causer', 'subject'])
            ->latest()
            ->paginate(20);

        return view('admin.log-aktivitas.index', compact('logs'));
    }
    
    // Log tidak boleh dihapus secara manual demi integritas sistem audit
}