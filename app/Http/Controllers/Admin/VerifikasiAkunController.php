<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Warga;
use Illuminate\Http\Request;

class VerifikasiAkunController extends Controller
{
    public function index(Request $request)
    {
        // Pastikan menarik dari Model Warga dengan status 'pending'
        $query = Warga::with('unitPosyandu')->where('status', 'pending');

        if ($request->has('search') && $request->search != '') {
            $query->where(function($q) use ($request) {
                $q->where('nama_lengkap', 'like', "%{$request->search}%")
                  ->orWhere('nik', 'like', "%{$request->search}%");
            });
        }

        $antrean = $query->latest()->paginate(10)->withQueryString();

        return view('admin.verifikasi.index', compact('antrean'));
    }

   public function setujui(Warga $warga)
{
    // Ubah status secara eksplisit menjadi 'aktif'
    $warga->update(['status' => 'aktif']);
    return redirect()->back()->with('success', 'Akun warga berhasil diverifikasi dan dipindahkan ke Kelola Warga.');
}

public function tolak(Warga $warga)
{
    $warga->update(['status' => 'nonaktif']);
    return redirect()->back()->with('success', 'Pendaftaran warga ditolak.');
}
}