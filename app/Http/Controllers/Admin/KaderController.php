<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kader;
use App\Models\UnitPosyandu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class KaderController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        
        $kaders = Kader::with('unit')->when($search, function($q) use ($search) {
            $q->where('nama', 'like', "%{$search}%")
              ->orWhere('email', 'like', "%{$search}%");
        })->latest()->paginate(10);
        
        return view('admin.kader.index', compact('kaders'));
    }

    public function create()
    {
        $units = UnitPosyandu::orderBy('nama', 'asc')->get();
        return view('admin.kader.create', compact('units'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:kader,email',
            'unit_posyandu_id' => 'required|exists:unit_posyandu,id',
        ]);

        // Generate password otomatis
        $rawPassword = Str::random(8);
        
        $kader = new Kader($validated);
        $kader->password = Hash::make($rawPassword);
        $kader->wajib_ganti_password = true; // Flag setup awal
        $kader->status = 'aktif';
        $kader->save();

        // Lempar raw password ke session flash untuk ditangkap di index
        return redirect()->route('admin.kader.index')
            ->with('success', 'Kader berhasil ditambahkan.')
            ->with('kredensial_baru', [
                'email' => $kader->email,
                'password' => $rawPassword
            ]);
    }

    public function edit(Kader $kader)
    {
        $units = UnitPosyandu::orderBy('nama', 'asc')->get();
        return view('admin.kader.edit', compact('kader', 'units'));
    }

    public function update(Request $request, Kader $kader)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:kader,email,' . $kader->id,
            'unit_posyandu_id' => 'required|exists:unit_posyandu,id',
            'status' => 'required|in:aktif,nonaktif',
        ]);

        $kader->update($validated);

        return redirect()->route('admin.kader.index')->with('success', 'Data kader berhasil diperbarui.');
    }

    // Inisiatif: Tambahkan fungsi reset manual agar admin bisa regenerate password jika lupa
    public function resetPassword(Kader $kader)
    {
        $rawPassword = Str::random(8);
        
        $kader->update([
            'password' => Hash::make($rawPassword),
            'wajib_ganti_password' => true
        ]);

        return redirect()->route('admin.kader.index')
            ->with('success', 'Password kader berhasil direset.')
            ->with('kredensial_baru', [
                'email' => $kader->email,
                'password' => $rawPassword
            ]);
    }
}