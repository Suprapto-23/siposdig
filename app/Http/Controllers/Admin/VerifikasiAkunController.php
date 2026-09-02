<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Warga;
use Illuminate\Http\Request;

class VerifikasiAkunController extends Controller
{
    public function index(Request $request)
    {
        $query = Warga::with('unitPosyandu')->where('status', 'pending');

        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nama_lengkap', 'like', "%{$search}%")
                  ->orWhere('nik', 'like', "%{$search}%");
            });
        }

        $antrean = $query->latest()->paginate(10)->withQueryString();

        return view('admin.verifikasi.index', compact('antrean'));
    }

    public function setujui(Warga $warga)
    {
        $warga->update(['status' => 'aktif']);
        return redirect()->back()->with('success', 'Akun warga berhasil diverifikasi dan dipindahkan ke Kelola Warga.');
    }

    public function tolak(Warga $warga)
    {
        $warga->update(['status' => 'nonaktif']);
        return redirect()->back()->with('success', 'Pendaftaran warga ditolak.');
    }
}