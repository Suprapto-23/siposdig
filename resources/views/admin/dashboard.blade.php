@extends('layouts.app-admin')

@section('title', 'Dashboard Admin - SIPOSDIG')

@section('content')
<div class="space-y-6 pb-8 animate-fade-in-up">

    <!-- ================= 1. BANNER UTAMA ================= -->
    <div class="relative overflow-hidden rounded-[2rem] bg-gradient-to-br from-white to-blue-50/50 border border-slate-200/60 p-8 sm:p-10 shadow-[0_8px_30px_rgba(37,99,235,0.04)] flex flex-col md:flex-row items-center justify-between">
        
        <!-- Sisi Kiri: Teks & Action -->
        <div class="relative z-10 w-full md:w-3/5 pr-0 md:pr-8">
            <div class="inline-flex items-center gap-2 rounded-full bg-blue-100/60 px-3.5 py-1.5 mb-6 border border-blue-200/50">
                <span class="h-2 w-2 rounded-full bg-blue-600 animate-pulse"></span>
                <span class="text-[10px] font-bold text-blue-700 tracking-widest uppercase">Pusat Kendali Admin</span>
            </div>
            
            <h1 class="font-display text-3xl sm:text-4xl lg:text-5xl font-extrabold text-slate-900 leading-[1.15] tracking-tight mb-4">
                Selamat Datang, <br>
                <span class="text-blue-600">Administrator SIPOSDIG</span>
            </h1>
            
            <p class="text-slate-500 text-sm sm:text-base font-medium leading-relaxed mb-8 max-w-xl">
                Pantau statistik operasional posyandu, kelola penempatan kader, dan verifikasi pendaftaran warga secara real-time dari satu pusat kendali terpadu.
            </p>
            
            <div class="flex flex-wrap items-center gap-3 sm:gap-4">
                <a href="{{ route('admin.verifikasi.index') }}" class="inline-flex items-center justify-center gap-2 px-6 py-3.5 bg-blue-600 text-white font-bold text-sm rounded-2xl shadow-[0_4px_14px_rgba(37,99,235,0.25)] hover:bg-blue-700 transition-all hover:-translate-y-0.5">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                    Verifikasi ({{ $statistik['antrean_verifikasi'] ?? 0 }})
                </a>
                
                <a href="{{ route('admin.kader.create') }}" class="inline-flex items-center justify-center gap-2 px-6 py-3.5 bg-white text-blue-600 border border-blue-200 font-bold text-sm rounded-2xl hover:bg-blue-50 transition-all">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                    Tambah Kader
                </a>
            </div>
        </div>

        <!-- Sisi Kanan: Ilustrasi SVG dari Repo -->
        <div class="relative z-10 w-full md:w-2/5 mt-10 md:mt-0 flex justify-end">
            <div class="w-full max-w-[320px] xl:max-w-[380px] aspect-square drop-shadow-sm">
                <!-- Memanggil file dashboard.svg sesuai repository -->
                <img src="{{ asset('assets/lottie/dashboard.svg') }}" alt="Ilustrasi SIPOSDIG" class="w-full h-full object-contain">
            </div>
        </div>
        
    </div>

    <!-- ================= 2. METRIK FUNGSIONAL ================= -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">

        <!-- Unit Posyandu -->
        <div class="bg-white rounded-3xl border border-slate-200/60 p-6 shadow-sm flex flex-col justify-between group hover:border-blue-300 hover:shadow-md transition-all">
            <div class="flex items-center justify-between mb-6">
                <span class="text-[11px] font-bold text-slate-400 uppercase tracking-widest">Unit Posyandu</span>
                <div class="p-3 bg-blue-50 text-blue-600 rounded-2xl group-hover:scale-110 transition-transform">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1v1H9V7zm5 0h1v1h-1V7zm-5 4h1v1H9v-1zm5 0h1v1h-1v-1zm-3-4h2a2 2 0 012 2v14H9V9a2 2 0 012-2z"/></svg>
                </div>
            </div>
            <div>
                <p class="font-display text-4xl font-extrabold text-slate-900 tracking-tight">{{ $statistik['total_unit'] ?? 0 }}</p>
                <p class="text-xs font-semibold text-slate-500 mt-2">Wilayah Operasional</p>
            </div>
        </div>

        <!-- Total Kader -->
        <div class="bg-white rounded-3xl border border-slate-200/60 p-6 shadow-sm flex flex-col justify-between group hover:border-violet-300 hover:shadow-md transition-all">
            <div class="flex items-center justify-between mb-6">
                <span class="text-[11px] font-bold text-slate-400 uppercase tracking-widest">Kader Aktif</span>
                <div class="p-3 bg-violet-50 text-violet-600 rounded-2xl group-hover:scale-110 transition-transform">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                </div>
            </div>
            <div>
                <p class="font-display text-4xl font-extrabold text-slate-900 tracking-tight">{{ $statistik['kader_aktif'] ?? 0 }}</p>
                <p class="text-xs font-semibold text-slate-500 mt-2">Petugas Lapangan</p>
            </div>
        </div>

        <!-- Warga Binaan -->
        <div class="bg-white rounded-3xl border border-slate-200/60 p-6 shadow-sm flex flex-col justify-between group hover:border-teal-300 hover:shadow-md transition-all">
            <div class="flex items-center justify-between mb-6">
                <span class="text-[11px] font-bold text-slate-400 uppercase tracking-widest">Warga Terdaftar</span>
                <div class="p-3 bg-teal-50 text-teal-600 rounded-2xl group-hover:scale-110 transition-transform">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                </div>
            </div>
            <div>
                <p class="font-display text-4xl font-extrabold text-slate-900 tracking-tight">{{ $statistik['warga_aktif'] ?? 0 }}</p>
                <p class="text-xs font-semibold text-slate-500 mt-2">Total Akun Aktif</p>
            </div>
        </div>

        <!-- Antrean -->
        <div class="bg-white rounded-3xl border border-slate-200/60 p-6 shadow-sm flex flex-col justify-between group hover:border-amber-300 hover:shadow-md transition-all">
            <div class="flex items-center justify-between mb-6">
                <span class="text-[11px] font-bold text-slate-400 uppercase tracking-widest">Perlu Verifikasi</span>
                <div class="p-3 bg-amber-50 text-amber-600 rounded-2xl group-hover:scale-110 transition-transform">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                </div>
            </div>
            <div>
                <p class="font-display text-4xl font-extrabold {{ ($statistik['antrean_verifikasi'] ?? 0) > 0 ? 'text-amber-600' : 'text-slate-900' }} tracking-tight">{{ $statistik['antrean_verifikasi'] ?? 0 }}</p>
                <p class="text-xs font-semibold text-slate-500 mt-2">Pendaftar Tertunda</p>
            </div>
        </div>
    </div>

    <!-- ================= 3. ANALITIK & KOMPLEKSITAS BAWAH ================= -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        
        <!-- Proporsi Kategori Warga -->
        <div class="lg:col-span-1 bg-white border border-slate-200/60 rounded-3xl p-6 shadow-sm">
            <h3 class="font-jakarta text-lg font-bold text-slate-900 mb-6 flex items-center gap-2">
                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z"></path></svg>
                Demografi Warga
            </h3>
            
            <div class="space-y-6">
                <!-- Balita -->
                <div>
                    <div class="flex justify-between items-end mb-2">
                        <div>
                            <span class="block text-sm font-bold text-slate-800">Kategori Balita</span>
                            <span class="text-xs text-slate-500 font-medium">Usia 0-59 Bulan</span>
                        </div>
                        <span class="font-display font-bold text-slate-900 text-xl tabular-nums">{{ $wargaPerKategori['Balita'] ?? 0 }}</span>
                    </div>
                    <div class="w-full bg-slate-100 rounded-full h-2.5 overflow-hidden">
                        @php $persenBalita = ($statistik['warga_aktif'] > 0) ? (($wargaPerKategori['Balita'] ?? 0) / $statistik['warga_aktif']) * 100 : 0; @endphp
                        <div class="bg-blue-500 h-full rounded-full transition-all duration-1000" style="width: {{ $persenBalita }}%"></div>
                    </div>
                </div>

                <!-- Remaja -->
                <div>
                    <div class="flex justify-between items-end mb-2">
                        <div>
                            <span class="block text-sm font-bold text-slate-800">Kategori Remaja</span>
                            <span class="text-xs text-slate-500 font-medium">Usia 10-18 Tahun</span>
                        </div>
                        <span class="font-display font-bold text-slate-900 text-xl tabular-nums">{{ $wargaPerKategori['Remaja'] ?? 0 }}</span>
                    </div>
                    <div class="w-full bg-slate-100 rounded-full h-2.5 overflow-hidden">
                        @php $persenRemaja = ($statistik['warga_aktif'] > 0) ? (($wargaPerKategori['Remaja'] ?? 0) / $statistik['warga_aktif']) * 100 : 0; @endphp
                        <div class="bg-teal-500 h-full rounded-full transition-all duration-1000" style="width: {{ $persenRemaja }}%"></div>
                    </div>
                </div>

                <!-- Lansia -->
                <div>
                    <div class="flex justify-between items-end mb-2">
                        <div>
                            <span class="block text-sm font-bold text-slate-800">Kategori Lansia</span>
                            <span class="text-xs text-slate-500 font-medium">Usia 60+ Tahun</span>
                        </div>
                        <span class="font-display font-bold text-slate-900 text-xl tabular-nums">{{ $wargaPerKategori['Lansia'] ?? 0 }}</span>
                    </div>
                    <div class="w-full bg-slate-100 rounded-full h-2.5 overflow-hidden">
                        @php $persenLansia = ($statistik['warga_aktif'] > 0) ? (($wargaPerKategori['Lansia'] ?? 0) / $statistik['warga_aktif']) * 100 : 0; @endphp
                        <div class="bg-violet-500 h-full rounded-full transition-all duration-1000" style="width: {{ $persenLansia }}%"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Aktivitas Terbaru (Audit Trail) -->
        <div class="lg:col-span-2 bg-white border border-slate-200/60 rounded-3xl shadow-sm overflow-hidden flex flex-col">
            <div class="px-6 py-5 border-b border-slate-100 flex justify-between items-center bg-slate-50/50">
                <h3 class="font-jakarta text-base font-bold text-slate-900 flex items-center gap-2">
                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    Aktivitas Sistem Terakhir
                </h3>
                <a href="{{ route('admin.log-aktivitas.index') }}" class="text-xs font-bold text-blue-600 hover:text-blue-800 transition-colors uppercase tracking-wider">Lihat Log &rarr;</a>
            </div>
            
            <div class="flex-1 overflow-y-auto">
                <div class="divide-y divide-slate-100/80">
                    @forelse($aktivitasTerbaru ?? [] as $log)
                    <div class="px-6 py-4 flex items-start gap-4 hover:bg-slate-50/80 transition-colors">
                        <div class="w-10 h-10 rounded-full bg-slate-100 flex items-center justify-center shrink-0 border border-slate-200 text-slate-500">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg>
                        </div>
                        <div>
                            <p class="text-sm text-slate-700 font-medium leading-snug">
                                <span class="font-bold text-slate-900">{{ $log->causer->name ?? 'Sistem' }}</span> 
                                {{ $log->description }}
                            </p>
                            <p class="text-xs font-semibold text-slate-400 mt-1 flex items-center gap-1.5">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                {{ $log->created_at->diffForHumans() }}
                            </p>
                        </div>
                    </div>
                    @empty
                    <div class="px-6 py-12 flex flex-col items-center justify-center text-center">
                        <div class="w-16 h-16 bg-slate-50 rounded-full flex items-center justify-center mb-3">
                            <svg class="w-8 h-8 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path></svg>
                        </div>
                        <p class="text-sm font-semibold text-slate-500">Belum ada aktivitas terekam.</p>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>

    </div>
</div>

<style>
    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(16px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .animate-fade-in-up { animation: fadeInUp 0.5s cubic-bezier(0.16, 1, 0.3, 1) forwards; }
</style>
@endsection