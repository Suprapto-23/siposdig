<?php

namespace App\Http\Controllers\Kader;

use App\Http\Controllers\Controller;
use App\Models\Absensi;
use App\Models\JadwalPosyandu;
use App\Models\Warga;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AbsensiController extends Controller
{
    public function index()
    {
        $kaderUnitId = auth('kader')->user()->unit_posyandu_id;

        // Tampilkan jadwal yang spesifik untuk unit posyandu kader ini
        $jadwal = JadwalPosyandu::withCount(['absensi' => function($q) {
            $q->where('status_hadir', 'hadir');
        }])
        ->where('unit_posyandu_id', $kaderUnitId)
        ->latest('tanggal')
        ->paginate(10);

        return view('kader.absensi.index', compact('jadwal'));
    }

    public function create($jadwalId)
    {
        $kaderUnitId = auth('kader')->user()->unit_posyandu_id;
        
        $jadwal = JadwalPosyandu::where('unit_posyandu_id', $kaderUnitId)->findOrFail($jadwalId);
        
        // Ambil warga beserta status absensinya jika sudah pernah diisi
        $warga = Warga::where('unit_posyandu_id', $kaderUnitId)
            ->where('status', 'aktif')
            ->orderBy('nama')
            ->get()
            ->map(function($w) use ($jadwalId) {
                $absen = Absensi::where('warga_id', $w->id)->where('jadwal_posyandu_id', $jadwalId)->first();
                $w->status_hadir = $absen ? $absen->status_hadir : null;
                $w->keterangan = $absen ? $absen->keterangan : null;
                return $w;
            });

        return view('kader.absensi.create', compact('jadwal', 'warga'));
    }

    public function store(Request $request, $jadwalId)
    {
        $kaderUnitId = auth('kader')->user()->unit_posyandu_id;
        $jadwal = JadwalPosyandu::where('unit_posyandu_id', $kaderUnitId)->findOrFail($jadwalId);

        $validated = $request->validate([
            'absensi' => 'required|array',
            'absensi.*.warga_id' => 'required|exists:warga,id',
            'absensi.*.status_hadir' => 'required|in:hadir,izin,sakit,alpa',
            'absensi.*.keterangan' => 'nullable|string|max:255',
        ]);

        // Verifikasi tambahan: pastikan semua warga_id yang dikirim benar-benar milik unit ini
        $wargaIds = collect($validated['absensi'])->pluck('warga_id');
        $validWargaCount = Warga::whereIn('id', $wargaIds)->where('unit_posyandu_id', $kaderUnitId)->count();
        
        if ($validWargaCount !== $wargaIds->count()) {
            return back()->with('error', 'Terdapat manipulasi data Warga ID.');
        }

        // Eksekusi Massal (Upsert) untuk performa database
        $upsertData = [];
        $now = now();
        
        foreach ($validated['absensi'] as $item) {
            $upsertData[] = [
                'jadwal_posyandu_id' => $jadwal->id,
                'warga_id' => $item['warga_id'],
                'status_hadir' => $item['status_hadir'],
                'keterangan' => $item['keterangan'],
                'created_at' => $now,
                'updated_at' => $now,
            ];
        }

        // Upsert mencocokkan jadwal_id & warga_id. Jika ada, update. Jika tidak, insert.
        // Pastikan Anda menambahkan composite unique index di migrasi: $table->unique(['jadwal_posyandu_id', 'warga_id']);
        Absensi::upsert(
            $upsertData,
            ['jadwal_posyandu_id', 'warga_id'],
            ['status_hadir', 'keterangan', 'updated_at']
        );

        return redirect()->route('kader.absensi.index')->with('success', 'Data absensi berhasil disimpan.');
    }
}