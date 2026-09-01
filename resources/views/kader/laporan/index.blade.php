@extends('layouts.app-kader')
@section('title', 'Laporan Unit Posyandu - SIPOSDIG')

@section('content')
<div class="space-y-6 pb-12 animate-fade-in-up">

    @php
        $namabulan = ['', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
    @endphp

    <!-- Header & Action Unduh Langsung PDF -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 bg-white/80 backdrop-blur-2xl border border-white p-6 rounded-[2rem] shadow-[0_8px_30px_rgba(37,99,235,0.04)]">
        <div>
            <h2 class="font-jakarta text-2xl font-black text-slate-800 tracking-tight">Laporan Posyandu</h2>
            <p class="text-[13px] text-slate-500 font-medium mt-1">Pratinjau dan unduh rekapitulasi data layanan bulanan.</p>
        </div>
        <!-- Link Ini Akan Memicu Download File PDF Secara Langsung -->
        <a href="{{ route('kader.laporan.cetak', ['bulan' => $bulan, 'tahun' => $tahun, 'kategori' => $kategori]) }}" class="inline-flex items-center justify-center gap-2 px-6 py-3.5 bg-gradient-to-r from-blue-500 to-sky-500 hover:from-blue-600 hover:to-sky-600 text-white font-extrabold text-sm rounded-full shadow-[0_8px_20px_-6px_rgba(14,165,233,0.4)] transition-all hover:-translate-y-0.5 focus:outline-none">
    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
    Unduh Laporan PDF
</a>
    </div>

    <!-- Filter Panel Premium Terang -->
    <form method="GET" action="{{ route('kader.laporan.index') }}" class="bg-white/90 backdrop-blur-2xl border border-white p-5 rounded-[2rem] shadow-[0_8px_30px_rgba(37,99,235,0.04)] grid grid-cols-1 md:grid-cols-4 gap-4 items-center">
        
        <div class="relative">
            <label class="block text-[10px] font-extrabold text-slate-400 uppercase tracking-widest mb-1.5 ml-2">Bulan</label>
            <select name="bulan" class="block w-full px-5 py-3.5 bg-slate-50/80 border border-slate-200 focus:bg-white focus:border-blue-400 rounded-2xl text-sm font-bold text-slate-700 outline-none cursor-pointer appearance-none transition-all">
                @for($i = 1; $i <= 12; $i++)
                    <option value="{{ sprintf('%02d', $i) }}" {{ $bulan == sprintf('%02d', $i) ? 'selected' : '' }}>{{ $namabulan[$i] }}</option>
                @endfor
            </select>
        </div>

        <div class="relative">
            <label class="block text-[10px] font-extrabold text-slate-400 uppercase tracking-widest mb-1.5 ml-2">Tahun</label>
            <select name="tahun" class="block w-full px-5 py-3.5 bg-slate-50/80 border border-slate-200 focus:bg-white focus:border-blue-400 rounded-2xl text-sm font-bold text-slate-700 outline-none cursor-pointer appearance-none transition-all">
                @for($y = date('Y'); $y >= 2024; $y--)
                    <option value="{{ $y }}" {{ $tahun == $y ? 'selected' : '' }}>{{ $y }}</option>
                @endfor
            </select>
        </div>

        <div class="relative">
            <label class="block text-[10px] font-extrabold text-slate-400 uppercase tracking-widest mb-1.5 ml-2">Kategori Sasaran</label>
            <select name="kategori" class="block w-full px-5 py-3.5 bg-slate-50/80 border border-slate-200 focus:bg-white focus:border-blue-400 rounded-2xl text-sm font-bold text-slate-700 outline-none cursor-pointer appearance-none transition-all">
                <option value="Semua" {{ $kategori == 'Semua' ? 'selected' : '' }}>Gabungan (Semua Data)</option>
                <option value="Balita" {{ $kategori == 'Balita' ? 'selected' : '' }}>Khusus Balita</option>
                <option value="Remaja" {{ $kategori == 'Remaja' ? 'selected' : '' }}>Khusus Remaja</option>
                <option value="Lansia" {{ $kategori == 'Lansia' ? 'selected' : '' }}>Khusus Lansia</option>
            </select>
        </div>

        <div class="pt-5">
            <button type="submit" class="w-full px-6 py-3.5 bg-blue-50 hover:bg-blue-100 text-blue-600 border border-blue-200 font-extrabold text-sm rounded-2xl transition-all shadow-sm cursor-pointer">
                Terapkan Filter
            </button>
        </div>
    </form>

    <!-- KARTU RINGKASAN PREMIUM -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        
        <!-- Widget Demografi -->
        <div class="bg-white/90 backdrop-blur-2xl border border-white p-6 rounded-[2rem] shadow-[0_8px_30px_rgba(37,99,235,0.04)]">
            <h3 class="text-[11px] font-extrabold text-slate-400 uppercase tracking-widest mb-4 flex items-center gap-2">
                <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                Total Warga Aktif
            </h3>
            <div class="flex items-end gap-3 mb-6">
                <span class="text-4xl font-black text-slate-800">{{ $totalWarga }}</span>
                <span class="text-sm font-bold text-slate-500 mb-1">Jiwa</span>
            </div>
            <div class="grid grid-cols-3 gap-3">
                <div class="bg-blue-50/70 p-3 rounded-xl border border-blue-100/50"><p class="text-[10px] font-extrabold text-blue-400 uppercase">Balita</p><p class="text-lg font-black text-blue-700">{{ $wargaBalita }}</p></div>
                <div class="bg-emerald-50/70 p-3 rounded-xl border border-emerald-100/50"><p class="text-[10px] font-extrabold text-emerald-400 uppercase">Remaja</p><p class="text-lg font-black text-emerald-700">{{ $wargaRemaja }}</p></div>
                <div class="bg-purple-50/70 p-3 rounded-xl border border-purple-100/50"><p class="text-[10px] font-extrabold text-purple-400 uppercase">Lansia</p><p class="text-lg font-black text-purple-700">{{ $wargaLansia }}</p></div>
            </div>
        </div>

        <!-- Widget Pengukuran -->
        <div class="bg-white/90 backdrop-blur-2xl border border-white p-6 rounded-[2rem] shadow-[0_8px_30px_rgba(37,99,235,0.04)]">
            <h3 class="text-[11px] font-extrabold text-slate-400 uppercase tracking-widest mb-4 flex items-center gap-2">
                <svg class="w-4 h-4 text-sky-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                Statistik Pengukuran ({{ $kategori }})
            </h3>
            <div class="flex items-end gap-3 mb-6">
                <span class="text-4xl font-black text-slate-800">{{ $summary['total_diukur'] }}</span>
                <span class="text-sm font-bold text-slate-500 mb-1">Orang Diukur</span>
            </div>
            <div class="grid grid-cols-2 gap-3">
                <div class="bg-slate-50 p-3 rounded-xl border border-slate-100/50"><p class="text-[10px] font-extrabold text-slate-400 uppercase">Rata-Rata BB</p><p class="text-lg font-black text-slate-700">{{ $summary['rata_berat'] }} <span class="text-[11px] text-slate-400">kg</span></p></div>
                <div class="bg-slate-50 p-3 rounded-xl border border-slate-100/50"><p class="text-[10px] font-extrabold text-slate-400 uppercase">Rata-Rata TB</p><p class="text-lg font-black text-slate-700">{{ $summary['rata_tinggi'] }} <span class="text-[11px] text-slate-400">cm</span></p></div>
            </div>
        </div>

    </div>

    <!-- PRATINJAU TABEL DATA -->
    <div class="bg-white/80 backdrop-blur-xl border border-slate-100 rounded-[2rem] shadow-[0_8px_30px_rgba(37,99,235,0.04)] overflow-hidden">
        <div class="p-6 border-b border-slate-100 flex items-center justify-between">
            <h3 class="text-sm font-black text-slate-800">Pratinjau Data Laporan</h3>
            <span class="px-3 py-1 bg-blue-50 text-blue-600 rounded-lg text-[10px] font-extrabold uppercase tracking-widest">{{ $kategori }}</span>
        </div>
        <div class="overflow-x-auto custom-scrollbar">
            <table class="w-full text-left border-collapse min-w-[800px]">
                <thead>
                    <tr class="bg-slate-50/50 border-b border-slate-100 text-[10px] uppercase tracking-widest font-extrabold text-slate-400">
                        <th class="px-6 py-4 whitespace-nowrap">Warga Binaan</th>
                        <th class="px-6 py-4 whitespace-nowrap text-center">Tanggal</th>
                        <th class="px-6 py-4 whitespace-nowrap text-center">BB / TB</th>
                        <th class="px-6 py-4 whitespace-nowrap text-center">Detail Kategori</th>
                        <th class="px-6 py-4 whitespace-nowrap">Catatan Medis</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100/80">
                    @forelse($dataLaporan as $item)
                    <tr class="hover:bg-blue-50/30 transition-colors">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <p class="text-sm font-bold text-slate-800">{{ $item->warga->nama_lengkap ?? '-' }}</p>
                            <p class="text-[11px] font-semibold text-slate-400 mt-0.5">NIK: {{ $item->warga->nik ?? '-' }}</p>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-bold text-slate-700">
                            {{ \Carbon\Carbon::parse($item->tanggal_ukur)->format('d/m/Y') }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-center">
                            <span class="text-sm font-black text-slate-800">{{ $item->berat_badan ?? '-' }}</span><span class="text-xs text-slate-400 font-bold">kg</span> / 
                            <span class="text-sm font-black text-slate-800">{{ $item->tinggi_badan ?? '-' }}</span><span class="text-xs text-slate-400 font-bold">cm</span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-center">
                            @if($item->kategori_saat_ukur == 'Balita')
                                <span class="px-2.5 py-1 bg-amber-50 text-amber-600 rounded border border-amber-100 text-xs font-bold">{{ $item->status_stunting ? ucwords(str_replace('_', ' ', $item->status_stunting)) : 'Stunting: -' }}</span>
                            @elseif($item->kategori_saat_ukur == 'Remaja')
                                <span class="px-2.5 py-1 bg-emerald-50 text-emerald-600 rounded border border-emerald-100 text-xs font-bold">Tensi: {{ $item->sistol }}/{{ $item->diastol }}</span>
                            @else
                                <span class="px-2.5 py-1 bg-purple-50 text-purple-600 rounded border border-purple-100 text-xs font-bold">Gula: {{ $item->gula_darah ?? '-' }}</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-xs font-medium text-slate-600 truncate max-w-[200px]">
                            {{ $item->catatan ?? '-' }}
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-12 text-center">
                            <div class="flex flex-col items-center justify-center">
                                <div class="w-14 h-14 bg-slate-50 rounded-full flex items-center justify-center mb-3"><svg class="w-6 h-6 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/></svg></div>
                                <p class="text-sm font-bold text-slate-500">Belum ada pengukuran di periode ini.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection