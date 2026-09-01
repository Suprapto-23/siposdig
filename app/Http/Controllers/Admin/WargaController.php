<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Warga;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class WargaController extends Controller
{
    public function index(Request $request)
    {
        $query = Warga::with('unit')->where('status', 'aktif');

        // Dynamic Filtering
        if ($request->filled('kategori')) {
            $query->where('kategori', $request->kategori);
        }
        if ($request->filled('unit_id')) {
            $query->where('unit_posyandu_id', $request->unit_id);
        }
        if ($request->filled('search')) {
            $query->where('nama', 'like', '%' . $request->search . '%')
                  ->orWhere('nik', 'like', '%' . $request->search . '%');
        }

        $warga = $query->latest()->paginate(15);
        $units = \App\Models\UnitPosyandu::select('id', 'nama')->get();

        return view('admin.warga.index', compact('warga', 'units'));
    }

    public function resetPassword(Warga $warga)
    {
        $rawPassword = Str::random(8);
        
        $warga->update([
            'password' => Hash::make($rawPassword),
            'wajib_ganti_password' => true
        ]);

        activity()->performedOn($warga)->causedBy(auth('admin')->user())->log('me-reset password warga');

        return back()
            ->with('success', 'Password Warga berhasil direset.')
            ->with('kredensial_warga', [
                'nik' => $warga->nik,
                'password' => $rawPassword,
                'nama' => $warga->nama
            ]);
    }
}