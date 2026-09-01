@extends('layouts.app-kader')
@section('title', 'Laporan Unit Posyandu - SIPOSDIG')

@section('content')
<div class="space-y-6 pb-12 animate-fade-in-up">

    @php
        $namabulan = ['', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
    @endphp

    <!-- Header & Action Cetak PDF -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 bg-white/80 backdrop-blur-2xl border border-white p-6 rounded-[2rem] shadow-[0_8px_30px_rgba(37,99,235,0.04)]">
        <div>
            <h2 class="font-jakarta text-2xl font-black text-slate-800 tracking-tight">Laporan Unit Posyandu</h2>
            <p class="text-[13px] text-slate-500 font-medium mt-1">Rekapitulasi data kegiatan bulanan dan indikator kesehatan warga terplot rapi.</p>
        </div>
        <a href="{{ route('kader.laporan.cetak', ['bulan' => $bulan, 'tahun' => $tahun, 'kategori' => $kategori]) }}" target="_blank" class="inline-flex items-center justify-center gap-2 px-6 py-3.5 bg-gradient-to-r from-blue-500 to-sky-500 hover:from-blue-600 text-white font-extrabold text-sm rounded-2xl shadow-[0_8px_20px_-6px_rgba(14,165,233,0.4)] transition-all">
    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/></svg>
    Cetak / Unduh Laporan PDF
</a>
    </div>

    <!-- Filter Panel (Terang Minimalis) -->
    <form method="GET" action="{{ route('kader.laporan.index') }}" class="bg-white/80 backdrop-blur-2xl border border-white p-6 rounded-[2rem] shadow-[0_8px_30px_rgba(37,99,235,0.04)] grid grid-cols-1 sm:grid-cols-4 gap-4 items-center relative z-40">
        
        <!-- Filter Bulan -->
        <div class="relative" id="dropdownBulan">
            <button type="button" onclick="toggleMenu('menuBulan')" class="flex items-center justify-between w-full px-5 py-3.5 bg-slate-50/80 hover:bg-white border border-slate-200 focus:border-blue-500 rounded-2xl text-sm font-bold text-slate-700 shadow-sm cursor-pointer transition-all">
                <span>Bulan: {{ $namabulan[intval($bulan)] }}</span>
                <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
            </button>
            <div id="menuBulan" class="hidden absolute top-full left-0 mt-2 w-full bg-white border border-slate-100 rounded-[1.25rem] shadow-xl py-2 max-h-60 overflow-y-auto z-50">
                @for($i = 1; $i <= 12; $i++)
                    <button type="submit" name="bulan" value="{{ sprintf('%02d', $i) }}" class="w-full text-left px-5 py-2.5 text-xs font-bold {{ $bulan == sprintf('%02d', $i) ? 'bg-blue-50 text-blue-600' : 'text-slate-600 hover:bg-slate-50' }}">{{ $namabulan[$i] }}</button>
                @endfor
            </div>
        </div>

        <!-- Filter Tahun -->
        <div class="relative" id="dropdownTahun">
            <button type="button" onclick="toggleMenu('menuTahun')" class="flex items-center justify-between w-full px-5 py-3.5 bg-slate-50/80 hover:bg-white border border-slate-200 focus:border-blue-500 rounded-2xl text-sm font-bold text-slate-700 shadow-sm cursor-pointer transition-all">
                <span>Tahun: {{ $tahun }}</span>
                <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
            </button>
            <div id="menuTahun" class="hidden absolute top-full left-0 mt-2 w-full bg-white border border-slate-100 rounded-[1.25rem] shadow-xl py-2 z-50">
                @for($y = date('Y'); $y >= 2024; $y--)
                    <button type="submit" name="tahun" value="{{ $y }}" class="w-full text-left px-5 py-2.5 text-xs font-bold {{ $tahun == $y ? 'bg-blue-50 text-blue-600' : 'text-slate-600 hover:bg-slate-50' }}">{{ $y }}</button>
                @endfor
            </div>
        </div>

        <!-- Filter Kategori Laporan -->
        <div class="relative" id="dropdownKat">
            <button type="button" onclick="toggleMenu('menuKat')" class="flex items-center justify-between w-full px-5 py-3.5 bg-slate-50/80 hover:bg-white border border-slate-200 focus:border-blue-500 rounded-2xl text-sm font-bold text-slate-700 shadow-sm cursor-pointer transition-all">
                <span>Kategori: {{ $kategori }}</span>
                <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
            </button>
            <div id="menuKat" class="hidden absolute top-full left-0 mt-2 w-full bg-white border border-slate-100 rounded-[1.25rem] shadow-xl py-2 z-50">
                <button type="submit" name="kategori" value="Semua" class="w-full text-left px-5 py-2.5 text-xs font-bold {{ $kategori == 'Semua' ? 'bg-blue-50 text-blue-600' : 'text-slate-600 hover:bg-slate-50' }}">Gabungan (Semua)</button>
                <button type="submit" name="kategori" value="Balita" class="w-full text-left px-5 py-2.5 text-xs font-bold {{ $kategori == 'Balita' ? 'bg-blue-50 text-blue-600' : 'text-slate-600 hover:bg-slate-50' }}">Khusus Balita</button>
                <button type="submit" name="kategori" value="Remaja" class="w-full text-left px-5 py-2.5 text-xs font-bold {{ $kategori == 'Remaja' ? 'bg-blue-50 text-blue-600' : 'text-slate-600 hover:bg-slate-50' }}">Khusus Remaja</button>
                <button type="submit" name="kategori" value="Lansia" class="w-full text-left px-5 py-2.5 text-xs font-bold {{ $kategori == 'Lansia' ? 'bg-blue-50 text-blue-600' : 'text-slate-600 hover:bg-slate-50' }}">Khusus Lansia</button>
            </div>
        </div>

        <div>
            <button type="submit" class="w-full px-6 py-3.5 bg-blue-50 hover:bg-blue-100 text-blue-600 border border-blue-200 font-extrabold text-sm rounded-2xl transition-all shadow-sm cursor-pointer">
                Terapkan Filter
            </button>
        </div>
    </form>

    <!-- PREVIEW DASHBOARD LAPORAN -->
    <div class="space-y-6 bg-white/80 backdrop-blur-2xl border border-white p-6 sm:p-8 rounded-[2rem] shadow-[0_8px_30px_rgba(0,0,0,0.03)]">
        <div>
            <h3 class="text-sm font-black text-slate-800 uppercase tracking-wider mb-4">1. Rekapitulasi Sasaran Warga Aktif</h3>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                <div class="bg-slate-50/80 p-5 rounded-2xl border border-slate-100"><p class="text-[11px] font-extrabold text-slate-400 uppercase tracking-widest">Total Warga</p><p class="text-2xl font-black text-slate-800 mt-1">{{ $totalWarga }} Jiwa</p></div>
                <div class="bg-blue-50/50 p-5 rounded-2xl border border-blue-100"><p class="text-[11px] font-extrabold text-blue-400 uppercase tracking-widest">Balita</p><p class="text-2xl font-black text-blue-700 mt-1">{{ $wargaBalita }} Anak</p></div>
                <div class="bg-emerald-50/50 p-5 rounded-2xl border border-emerald-100"><p class="text-[11px] font-extrabold text-emerald-400 uppercase tracking-widest">Remaja</p><p class="text-2xl font-black text-emerald-700 mt-1">{{ $wargaRemaja }} Jiwa</p></div>
                <div class="bg-purple-50/50 p-5 rounded-2xl border border-purple-100"><p class="text-[11px] font-extrabold text-purple-400 uppercase tracking-widest">Lansia</p><p class="text-2xl font-black text-purple-700 mt-1">{{ $wargaLansia }} Jiwa</p></div>
            </div>
        </div>

        <div>
            <h3 class="text-sm font-black text-slate-800 uppercase tracking-wider mb-4">2. Ringkasan Pengukuran (Kategori: {{ $kategori }})</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="p-5 rounded-2xl border border-slate-100 bg-white shadow-sm"><p class="text-[11px] font-extrabold text-slate-400 uppercase tracking-widest">Total Diukur</p><p class="text-xl font-black text-slate-800 mt-1">{{ $summary['total_diukur'] }} Orang</p></div>
                <div class="p-5 rounded-2xl border border-slate-100 bg-white shadow-sm"><p class="text-[11px] font-extrabold text-slate-400 uppercase tracking-widest">Rata-rata Berat Badan</p><p class="text-xl font-black text-slate-800 mt-1">{{ $summary['rata_berat'] }} kg</p></div>
                <div class="p-5 rounded-2xl border border-slate-100 bg-white shadow-sm"><p class="text-[11px] font-extrabold text-slate-400 uppercase tracking-widest">Rata-rata Tinggi Badan</p><p class="text-xl font-black text-slate-800 mt-1">{{ $summary['rata_tinggi'] }} cm</p></div>
            </div>
        </div>
    </div>
</div>

<script>
    function toggleMenu(id) {
        ['menuBulan', 'menuTahun', 'menuKat'].forEach(m => {
            if (m !== id) document.getElementById(m).classList.add('hidden');
        });
        document.getElementById(id).classList.toggle('hidden');
    }

    document.addEventListener('click', function(event) {
        if (!event.target.closest('form') && !event.target.closest('button')) {
            ['menuBulan', 'menuTahun', 'menuKat'].forEach(m => document.getElementById(m).classList.add('hidden'));
        }
    });
</script>
@endsection