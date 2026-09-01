@extends('layouts.app-kader')

@section('title', 'Dashboard Kader - SIPOSDIG')

@section('content')
<div class="space-y-6 pb-8 animate-fade-in-up">

    <!-- ================= 1. BANNER UTAMA KADER ================= -->
    <div class="relative overflow-hidden rounded-[2rem] bg-gradient-to-br from-white to-blue-50/40 border border-slate-200/60 p-8 sm:p-10 shadow-[0_8px_30px_rgba(37,99,235,0.04)] flex flex-col md:flex-row items-center justify-between">
        
        <!-- Sisi Kiri: Teks & Action -->
        <div class="relative z-10 w-full md:w-3/5 pr-0 md:pr-8">
            <div class="inline-flex items-center gap-2 rounded-full bg-blue-50 px-3.5 py-1.5 mb-6 border border-blue-100/80">
                <span class="h-2 w-2 rounded-full bg-blue-500 animate-pulse"></span>
                <span class="text-[10px] font-bold text-blue-700 tracking-widest uppercase">
                    {{ auth('kader')->user()->unitPosyandu->nama ?? 'Unit Posyandu' }}
                </span>
            </div>
            
            <h1 class="font-jakarta text-3xl sm:text-4xl lg:text-5xl font-extrabold text-slate-800 leading-[1.15] tracking-tight mb-4">
                Selamat Bertugas, <br>
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-sky-500">
                    {{ auth('kader')->user()->nama ?? 'Kader Kesehatan' }}
                </span>
            </h1>
            
            <p class="text-slate-500 text-sm sm:text-base font-medium leading-relaxed mb-8 max-w-xl">
                Mari pantau tumbuh kembang warga binaan kita. Awali hari dengan mencatat kehadiran dan melakukan pengukuran fisik secara akurat.
            </p>
            
            <div class="flex flex-wrap items-center gap-3 sm:gap-4">
                <!-- Tombol Aksi Cepat (Vibrant Blue) -->
                <a href="{{ route('kader.pengukuran.index') }}" class="inline-flex items-center justify-center gap-2 px-6 py-3.5 bg-gradient-to-r from-blue-500 to-sky-500 text-white font-bold text-sm rounded-2xl shadow-[0_8px_20px_-6px_rgba(14,165,233,0.4)] hover:from-blue-600 hover:to-sky-500 transition-all hover:-translate-y-0.5 focus:outline-none">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/></svg>
                    Mulai Pengukuran
                </a>
                
                <a href="{{ route('kader.absensi.index') }}" class="inline-flex items-center justify-center gap-2 px-6 py-3.5 bg-white text-blue-600 border border-blue-200 font-bold text-sm rounded-2xl hover:bg-blue-50 shadow-sm transition-all focus:outline-none">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/></svg>
                    Isi Absensi
                </a>
            </div>
        </div>

        <!-- Sisi Kanan: Ornamen Medis -->
        <div class="relative z-10 w-full md:w-2/5 mt-10 md:mt-0 flex justify-end">
            <div class="w-full max-w-[320px] aspect-square relative flex items-center justify-center">
                <div class="absolute inset-0 bg-gradient-to-tr from-blue-200/30 to-sky-100/40 rounded-full blur-3xl animate-pulse" style="animation-duration: 4s;"></div>
                <div class="w-40 h-40 bg-white rounded-full shadow-[0_10px_40px_-10px_rgba(37,99,235,0.2)] flex items-center justify-center relative z-10" style="animation: float 6s ease-in-out infinite;">
                    <svg class="w-20 h-20 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v4m-2-2h4"></path></svg>
                </div>
            </div>
        </div>
        
    </div>

    <!-- ================= 2. METRIK WARGA BINAAN ================= -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">

        <!-- Total Warga Binaan -->
        <div class="bg-white rounded-[2rem] border border-slate-100 p-6 shadow-sm flex flex-col justify-between group hover:shadow-md hover:border-blue-100 transition-all">
            <div class="flex items-center justify-between mb-4">
                <span class="text-[11px] font-bold text-slate-400 uppercase tracking-widest">Warga Binaan</span>
                <div class="p-2.5 bg-blue-50 text-blue-600 rounded-xl group-hover:scale-110 transition-transform">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                </div>
            </div>
            <div>
                <p class="font-jakarta text-4xl font-extrabold text-slate-800 tracking-tight">{{ $statistik['total_warga'] ?? 0 }}</p>
                <p class="text-xs font-semibold text-slate-400 mt-1">Total di Unit Ini</p>
            </div>
        </div>

        <!-- Balita (Sky Blue) -->
        <div class="bg-white rounded-[2rem] border border-slate-100 p-6 shadow-sm flex flex-col justify-between group hover:shadow-md hover:border-sky-100 transition-all">
            <div class="flex items-center justify-between mb-4">
                <span class="text-[11px] font-bold text-slate-400 uppercase tracking-widest">Kategori Balita</span>
                <div class="p-2.5 bg-sky-50 text-sky-500 rounded-xl group-hover:scale-110 transition-transform">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
            </div>
            <div>
                <p class="font-jakarta text-4xl font-extrabold text-slate-800 tracking-tight">{{ $statistik['total_balita'] ?? 0 }}</p>
                <p class="text-xs font-semibold text-slate-400 mt-1">0 - 59 Bulan</p>
            </div>
        </div>

        <!-- Remaja (Indigo Soft) -->
        <div class="bg-white rounded-[2rem] border border-slate-100 p-6 shadow-sm flex flex-col justify-between group hover:shadow-md hover:border-indigo-100 transition-all">
            <div class="flex items-center justify-between mb-4">
                <span class="text-[11px] font-bold text-slate-400 uppercase tracking-widest">Kategori Remaja</span>
                <div class="p-2.5 bg-indigo-50/60 text-indigo-500 rounded-xl group-hover:scale-110 transition-transform">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                </div>
            </div>
            <div>
                <p class="font-jakarta text-4xl font-extrabold text-slate-800 tracking-tight">{{ $statistik['total_remaja'] ?? 0 }}</p>
                <p class="text-xs font-semibold text-slate-400 mt-1">10 - 18 Tahun</p>
            </div>
        </div>

        <!-- Lansia (Slate Neutral) -->
        <div class="bg-white rounded-[2rem] border border-slate-100 p-6 shadow-sm flex flex-col justify-between group hover:shadow-md hover:border-slate-200 transition-all">
            <div class="flex items-center justify-between mb-4">
                <span class="text-[11px] font-bold text-slate-400 uppercase tracking-widest">Kategori Lansia</span>
                <div class="p-2.5 bg-slate-100 text-slate-500 rounded-xl group-hover:scale-110 transition-transform">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"/></svg>
                </div>
            </div>
            <div>
                <p class="font-jakarta text-4xl font-extrabold text-slate-800 tracking-tight">{{ $statistik['total_lansia'] ?? 0 }}</p>
                <p class="text-xs font-semibold text-slate-400 mt-1">60+ Tahun</p>
            </div>
        </div>
    </div>

    <!-- ================= 3. JADWAL & RIWAYAT TERBARU ================= -->
    <div class="grid grid-cols-1 xl:grid-cols-2 gap-6">
        
        <!-- Panel Jadwal Posyandu -->
        <div class="bg-white border border-slate-100 rounded-[2rem] p-6 shadow-sm flex flex-col h-full">
            <div class="flex items-center justify-between mb-6">
                <h3 class="font-jakarta text-lg font-bold text-slate-800 flex items-center gap-2">
                    <div class="w-8 h-8 rounded-full bg-blue-50 flex items-center justify-center text-blue-600">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    </div>
                    Jadwal Posyandu Unit Anda
                </h3>
            </div>
            
            <div class="flex-1 space-y-4">
                @forelse($jadwalMendatang ?? [] as $jadwal)
                <div class="flex items-center gap-4 p-4 rounded-2xl border border-slate-100 bg-slate-50/50 hover:bg-blue-50/50 hover:border-blue-100 transition-colors">
                    <div class="w-14 h-14 rounded-2xl bg-white border border-slate-200 flex flex-col items-center justify-center shrink-0 shadow-sm">
                        <span class="text-[10px] font-bold text-slate-400 uppercase">{{ \Carbon\Carbon::parse($jadwal->tanggal)->translatedFormat('M') }}</span>
                        <span class="text-lg font-extrabold text-blue-600 leading-none">{{ \Carbon\Carbon::parse($jadwal->tanggal)->format('d') }}</span>
                    </div>
                    <div>
                        <h4 class="text-sm font-bold text-slate-800">{{ $jadwal->judul_kegiatan }}</h4>
                        <div class="flex items-center gap-3 mt-1.5 text-xs font-semibold text-slate-500">
                            <span class="flex items-center gap-1">
                                <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                {{ \Carbon\Carbon::parse($jadwal->waktu_mulai)->format('H:i') }} WIB
                            </span>
                            <span class="px-2 py-0.5 rounded-md bg-white border border-slate-200 text-[10px] text-slate-600">
                                {{ ucwords(str_replace('_', ' ', $jadwal->jenis_kegiatan)) }}
                            </span>
                        </div>
                    </div>
                </div>
                @empty
                <div class="h-full flex flex-col items-center justify-center py-8 text-center">
                    <div class="w-16 h-16 bg-slate-50 rounded-full flex items-center justify-center mb-3">
                        <svg class="w-8 h-8 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    </div>
                    <p class="text-sm font-semibold text-slate-500">Belum ada jadwal posyandu mendatang.</p>
                </div>
                @endforelse
            </div>
        </div>

        <!-- Panel Riwayat Pengukuran -->
        <div class="bg-white border border-slate-100 rounded-[2rem] p-6 shadow-sm flex flex-col h-full">
            <div class="flex items-center justify-between mb-6">
                <h3 class="font-jakarta text-lg font-bold text-slate-800 flex items-center gap-2">
                    <div class="w-8 h-8 rounded-full bg-sky-50 flex items-center justify-center text-sky-600">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/></svg>
                    </div>
                    Pemeriksaan Terakhir
                </h3>
                <a href="{{ route('kader.pengukuran.index') }}" class="text-xs font-bold text-blue-600 hover:text-blue-700 transition-colors uppercase tracking-wider">Lihat Semua</a>
            </div>
            
            <div class="flex-1 space-y-4">
                @forelse($pengukuranTerbaru ?? [] as $ukur)
                <div class="flex items-center justify-between p-3.5 rounded-2xl border border-slate-100 hover:bg-slate-50 transition-colors">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-full bg-slate-100 border border-slate-200 flex items-center justify-center text-slate-500 font-bold shrink-0">
                            {{ substr($ukur->warga->nama ?? 'W', 0, 1) }}
                        </div>
                        <div>
                            <h4 class="text-sm font-bold text-slate-800">{{ $ukur->warga->nama ?? 'Nama Warga' }}</h4>
                            <p class="text-xs font-semibold text-slate-500">{{ ucwords($ukur->kategori_saat_ukur) }} • {{ \Carbon\Carbon::parse($ukur->tanggal_ukur)->format('d/m/Y') }}</p>
                        </div>
                    </div>
                    <div class="text-right">
                        @if($ukur->kategori_saat_ukur === 'balita')
                            <span class="block text-sm font-extrabold text-slate-700">{{ $ukur->berat_badan ?? '-' }} kg</span>
                        @else
                            <span class="block text-sm font-extrabold text-slate-700">{{ $ukur->sistol ?? '-' }}/{{ $ukur->diastol ?? '-' }}</span>
                        @endif
                    </div>
                </div>
                @empty
                <div class="h-full flex flex-col items-center justify-center py-8 text-center">
                    <div class="w-16 h-16 bg-slate-50 rounded-full flex items-center justify-center mb-3">
                        <svg class="w-8 h-8 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                    </div>
                    <p class="text-sm font-semibold text-slate-500">Belum ada riwayat pengukuran.</p>
                </div>
                @endforelse
            </div>
        </div>

    </div>
</div>

<style>
    @keyframes float {
        0%, 100% { transform: translateY(0px); }
        50% { transform: translateY(-8px); }
    }
    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(16px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .animate-fade-in-up { animation: fadeInUp 0.5s cubic-bezier(0.16, 1, 0.3, 1) forwards; }
</style>
@endsection