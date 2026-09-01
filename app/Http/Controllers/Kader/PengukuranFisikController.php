<?php

namespace App\Http\Controllers\Kader;

use App\Http\Controllers\Controller;
use App\Models\PengukuranFisik;
use App\Models\Warga;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class PengukuranFisikController extends Controller
{
    public function index(Request $request)
    {
        $kaderUnitId = auth('kader')->user()->unit_posyandu_id;
        
        $query = PengukuranFisik::with('warga')->whereHas('warga', function($q) use ($kaderUnitId) {
            $q->where('unit_posyandu_id', $kaderUnitId);
        });

        // Filter dinamis
        if ($request->filled('kategori')) {
            $query->whereHas('warga', function($q) use ($request) {
                $q->where('kategori', $request->kategori);
            });
        }
        
        if ($request->filled('bulan') && $request->filled('tahun')) {
            $query->whereMonth('tanggal_ukur', $request->bulan)
                  ->whereYear('tanggal_ukur', $request->tahun);
        }

        $pengukuran = $query->latest('tanggal_ukur')->paginate(15);

        return view('kader.pengukuran.index', compact('pengukuran'));
    }

    public function create()
    {
        $kaderUnitId = auth('kader')->user()->unit_posyandu_id;

        // Ambil warga aktif yang BELUM diukur bulan ini untuk mempermudah kader (Dropdown pintar)
        $bulanIni = Carbon::now()->format('m');
        $tahunIni = Carbon::now()->format('Y');

        $wargaBinaan = Warga::where('unit_posyandu_id', $kaderUnitId)
            ->where('status', 'aktif')
            ->whereDoesntHave('pengukuran', function($q) use ($bulanIni, $tahunIni) {
                $q->whereMonth('tanggal_ukur', $bulanIni)
                  ->whereYear('tanggal_ukur', $tahunIni);
            })
            ->select('id', 'nama', 'kategori', 'nik')
            ->orderBy('nama')
            ->get();

        return view('kader.pengukuran.create', compact('wargaBinaan'));
    }

    public function store(Request $request)
    {
        $kaderId = auth('kader')->id();
        $kaderUnitId = auth('kader')->user()->unit_posyandu_id;

        // 1. Ambil & pastikan Warga ada di unit Kader ini
        $warga = Warga::where('unit_posyandu_id', $kaderUnitId)->findOrFail($request->warga_id);

        // 2. Proteksi Duplikasi: Cek apakah warga ini sudah diukur di bulan dan tahun yang sama
        $tanggalInput = Carbon::parse($request->tanggal_ukur);
        $cekDuplikat = PengukuranFisik::where('warga_id', $warga->id)
            ->whereMonth('tanggal_ukur', $tanggalInput->format('m'))
            ->whereYear('tanggal_ukur', $tanggalInput->format('Y'))
            ->exists();

        if ($cekDuplikat) {
            return back()->withInput()->with('error', 'Warga ini sudah memiliki data pengukuran di bulan tersebut. Silakan edit data yang sudah ada.');
        }

        // 3. Validasi Dinamis berdasarkan Kategori Warga
        $rules = [
            'warga_id' => 'required|exists:warga,id',
            'tanggal_ukur' => 'required|date|before_or_equal:today',
            'berat_badan' => 'required|numeric|min:1|max:200',
            'tinggi_badan' => 'required|numeric|min:10|max:250',
        ];

        if ($warga->kategori === 'Balita') {
            $rules['lingkar_kepala'] = 'required|numeric|min:10|max:100';
            $rules['lila'] = 'required|numeric|min:5|max:50'; // LILA balita
        } elseif ($warga->kategori === 'Lansia') {
            $rules['tekanan_darah_sistol'] = 'required|integer|min:50|max:250';
            $rules['tekanan_darah_diastol'] = 'required|integer|min:30|max:150';
            $rules['gula_darah'] = 'nullable|numeric|min:10|max:600';
            $rules['kolesterol'] = 'nullable|numeric|min:50|max:500';
        } elseif ($warga->kategori === 'Remaja') {
            $rules['tekanan_darah_sistol'] = 'nullable|integer';
            $rules['tekanan_darah_diastol'] = 'nullable|integer';
        }

        $validated = $request->validate($rules);
        $validated['kader_id'] = $kaderId;

        // 4. Kalkulasi Otomatis (Auto-IMT)
        // IMT = Berat (kg) / (Tinggi (m) * Tinggi (m))
        if (in_array($warga->kategori, ['Remaja', 'Lansia'])) {
            $tinggiMeter = $validated['tinggi_badan'] / 100;
            if ($tinggiMeter > 0) {
                $validated['imt'] = round($validated['berat_badan'] / ($tinggiMeter * $tinggiMeter), 2);
            }
        }

        DB::transaction(function () use ($validated) {
            PengukuranFisik::create($validated);
        });

        return redirect()->route('kader.pengukuran.index')->with('success', 'Data pengukuran fisik berhasil dicatat.');
    }

    public function edit($id)
    {
        $kaderUnitId = auth('kader')->user()->unit_posyandu_id;
        
        $pengukuran = PengukuranFisik::with('warga')
            ->whereHas('warga', function($q) use ($kaderUnitId) {
                $q->where('unit_posyandu_id', $kaderUnitId);
            })
            ->findOrFail($id);

        return view('kader.pengukuran.edit', compact('pengukuran'));
    }

    public function update(Request $request, $id)
    {
        $kaderUnitId = auth('kader')->user()->unit_posyandu_id;

        $pengukuran = PengukuranFisik::with('warga')
            ->whereHas('warga', function($q) use ($kaderUnitId) {
                $q->where('unit_posyandu_id', $kaderUnitId);
            })
            ->findOrFail($id);

        $warga = $pengukuran->warga;

        $rules = [
            'tanggal_ukur' => 'required|date|before_or_equal:today',
            'berat_badan' => 'required|numeric|min:1|max:200',
            'tinggi_badan' => 'required|numeric|min:10|max:250',
        ];

        if ($warga->kategori === 'Balita') {
            $rules['lingkar_kepala'] = 'required|numeric';
            $rules['lila'] = 'required|numeric';
        } elseif ($warga->kategori === 'Lansia') {
            $rules['tekanan_darah_sistol'] = 'required|integer';
            $rules['tekanan_darah_diastol'] = 'required|integer';
            $rules['gula_darah'] = 'nullable|numeric';
            $rules['kolesterol'] = 'nullable|numeric';
        }

        $validated = $request->validate($rules);

        // Recalculate IMT on update
        if (in_array($warga->kategori, ['Remaja', 'Lansia'])) {
            $tinggiMeter = $validated['tinggi_badan'] / 100;
            if ($tinggiMeter > 0) {
                $validated['imt'] = round($validated['berat_badan'] / ($tinggiMeter * $tinggiMeter), 2);
            }
        }

        $pengukuran->update($validated);

        return redirect()->route('kader.pengukuran.index')->with('success', 'Data pengukuran fisik berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $kaderUnitId = auth('kader')->user()->unit_posyandu_id;

        $pengukuran = PengukuranFisik::whereHas('warga', function($q) use ($kaderUnitId) {
            $q->where('unit_posyandu_id', $kaderUnitId);
        })->findOrFail($id);

        $pengukuran->delete();

        return back()->with('success', 'Data pengukuran fisik berhasil dihapus.');
    }
}