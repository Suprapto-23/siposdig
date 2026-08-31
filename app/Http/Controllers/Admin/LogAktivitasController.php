<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LogAktivitas;
use Illuminate\Http\Request;

class LogAktivitasController extends Controller 
{
    public function index(Request $request) 
    {
        // Fitur pencarian log (opsional tapi sangat fungsional)
        $query = LogAktivitas::query();

        if ($request->has('cari')) {
            $query->where('pelaku', 'like', '%' . $request->cari . '%')
                  ->orWhere('aksi', 'like', '%' . $request->cari . '%')
                  ->orWhere('deskripsi', 'like', '%' . $request->cari . '%');
        }

        $logs = $query->latest()->paginate(15);
        
        return view('admin.log-aktivitas.index', compact('logs'));
    }

    // Fitur hapus log jika diperlukan (Opsional: Bersihkan Log)
    public function clear() 
    {
        LogAktivitas::truncate();
        return redirect()->route('admin.log-aktivitas')->with('success', 'Seluruh log aktivitas berhasil dibersihkan.');
    }
}