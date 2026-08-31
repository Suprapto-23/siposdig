@extends('layouts.app-admin')

@section('title', 'Dashboard Admin - SIPOSDIG')

@section('content')
<div class="space-y-6 pb-8 animate-fade-in-up">

    <!-- ================= 1. BANNER UTAMA (FULL WIDTH) ================= -->
<div class="relative overflow-hidden rounded-3xl bg-white border border-slate-200/60 p-8 shadow-[0_8px_30px_rgba(37,99,235,0.04)]">
    
    <!-- Header Banner: Label & Waktu -->
    <div class="flex flex-col md:flex-row md:items-center justify-between mb-4 relative z-10">
        <div class="inline-flex items-center gap-2 rounded-full bg-blue-50 px-4 py-2 border border-blue-100/80">
            <span class="h-2 w-2 rounded-full bg-blue-600 animate-pulse"></span>
            <span class="text-[11px] font-bold text-blue-700 tracking-widest uppercase">Pusat Kendali Utama</span>
        </div>
        
        <div class="mt-4 md:mt-0 flex items-center gap-3 bg-slate-50 px-4 py-2 rounded-2xl border border-slate-100">
            <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            <div x-data="timeWidget()" x-init="init()" class="flex items-center gap-2">
                <span class="text-xs font-semibold text-slate-600" x-text="dateText"></span>
                <span class="text-slate-300">|</span>
                <span class="font-display text-sm font-bold text-slate-900 tabular-nums tracking-wider" x-text="timeText"></span>
            </div>
        </div>
    </div>

    <!-- Konten Teks & Lottie -->
    <div class="flex flex-col lg:flex-row items-center justify-between relative z-10 gap-8">
        
        <!-- Sisi Kiri: Teks -->
        <div class="max-w-2xl pt-4">
            <h1 class="font-display text-3xl lg:text-4xl font-extrabold text-slate-900 leading-tight tracking-tight">
                Selamat Datang, <span class="text-blue-600">Administrator</span>
            </h1>
            <p class="mt-4 text-slate-500 text-sm leading-relaxed max-w-xl">
                Akses kontrol penuh operasional SIPOSDIG. Validasi data warga, setujui pendaftaran kader lapangan, dan pantau jadwal posyandu secara *real-time* dari satu layar.
            </p>
            <div class="mt-8 flex flex-wrap items-center gap-4">
                <button class="rounded-2xl bg-blue-600 px-6 py-3.5 text-xs font-bold text-white shadow-lg shadow-blue-600/30 hover:bg-blue-700 transition-all flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                    Registrasi Kader Baru
                </button>
                <button class="rounded-2xl bg-white border border-slate-200 px-6 py-3.5 text-xs font-bold text-slate-700 hover:bg-slate-50 transition-all flex items-center gap-2">
                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                    Unduh Rekap Bulanan
                </button>
            </div>
        </div>

        <!-- Sisi Kanan: Animasi Lottie (Sesuai area lingkaran merah) -->
        <div class="hidden lg:flex shrink-0 w-[280px] h-[280px] items-center justify-center">
            <!-- Source diubah menggunakan asset sesuai request Anda -->
            <img src="{{ asset('assets/lottie/dashboard.svg') }}" class="w-full h-full object-contain" alt="Animasi Dashboard">
        </div>

    </div>
    <!-- Ornamen Latar -->
    <div class="absolute -right-20 -bottom-20 w-96 h-96 rounded-full bg-blue-50/80 blur-3xl z-0 pointer-events-none"></div>
</div>


    <!-- ================= 2. METRIK FUNGSIONAL (KONSISTEN BIRU) ================= -->
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6">
        
        <!-- Metrik 1 -->
        <div class="bg-white rounded-3xl border border-slate-200/60 p-6 shadow-[0_4px_20px_rgba(0,0,0,0.02)] flex flex-col justify-between group hover:border-blue-200 transition-colors">
            <div class="flex items-center justify-between mb-4">
                <span class="text-[11px] font-bold text-slate-400 uppercase tracking-widest">Unit Posyandu</span>
                <div class="p-2.5 bg-blue-50 text-blue-600 rounded-xl group-hover:scale-110 transition-transform">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1v1H9V7zm5 0h1v1h-1V7zm-5 4h1v1H9v-1zm5 0h1v1h-1v-1zm-3-4h2a2 2 0 012 2v14H9V9a2 2 0 012-2z"/></svg>
                </div>
            </div>
            <div>
                <p class="font-display text-4xl font-extrabold text-slate-900 tracking-tight">8</p>
                <p class="text-[11px] font-bold text-slate-500 mt-1 uppercase">Wilayah Operasional</p>
            </div>
        </div>

        <!-- Metrik 2 -->
        <div class="bg-white rounded-3xl border border-slate-200/60 p-6 shadow-[0_4px_20px_rgba(0,0,0,0.02)] flex flex-col justify-between group hover:border-blue-200 transition-colors">
            <div class="flex items-center justify-between mb-4">
                <span class="text-[11px] font-bold text-slate-400 uppercase tracking-widest">Total Kader</span>
                <div class="p-2.5 bg-sky-50 text-sky-600 rounded-xl group-hover:scale-110 transition-transform">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                </div>
            </div>
            <div>
                <p class="font-display text-4xl font-extrabold text-slate-900 tracking-tight">32</p>
                <p class="text-[11px] font-bold text-slate-500 mt-1 uppercase">Kader Bertugas</p>
            </div>
        </div>

        <!-- Metrik 3 -->
        <div class="bg-white rounded-3xl border border-slate-200/60 p-6 shadow-[0_4px_20px_rgba(0,0,0,0.02)] flex flex-col justify-between group hover:border-blue-200 transition-colors">
            <div class="flex items-center justify-between mb-4">
                <span class="text-[11px] font-bold text-slate-400 uppercase tracking-widest">Warga Binaan</span>
                <div class="p-2.5 bg-indigo-50 text-indigo-600 rounded-xl group-hover:scale-110 transition-transform">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                </div>
            </div>
            <div>
                <p class="font-display text-4xl font-extrabold text-slate-900 tracking-tight">145</p>
                <div class="flex gap-2 mt-2">
                    <span class="px-2 py-1 rounded-md bg-blue-50 text-blue-700 text-[10px] font-bold border border-blue-100/50">80 Balita</span>
                    <span class="px-2 py-1 rounded-md bg-slate-100 text-slate-600 text-[10px] font-bold border border-slate-200/50">65 Lansia</span>
                </div>
            </div>
        </div>

        <!-- Metrik 4: Aksi Diperlukan -->
        <div class="bg-blue-600 rounded-3xl p-6 shadow-lg shadow-blue-600/20 text-white flex flex-col justify-between relative overflow-hidden">
            <div class="absolute -right-6 -top-6 opacity-20">
                <svg class="w-32 h-32" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-2h2v2zm0-4h-2V7h2v6z"/></svg>
            </div>
            <div class="flex items-center justify-between mb-4 relative z-10">
                <span class="text-[11px] font-bold text-blue-200 uppercase tracking-widest">Tindakan Tertunda</span>
                <span class="flex h-3 w-3 rounded-full bg-white animate-ping"></span>
            </div>
            <div class="relative z-10">
                <p class="font-display text-4xl font-extrabold tracking-tight">12</p>
                <p class="text-[11px] font-bold text-blue-100 mt-1 uppercase">Antrean NIK Warga Baru</p>
            </div>
        </div>
    </div>


    <!-- ================= 3. PANEL FUNGSI SPESIFIK & JADWAL ================= -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        
        <!-- Panel 1: Validasi & Tindakan (Berfungsi Langsung) -->
        <div class="rounded-3xl bg-white border border-slate-200/60 shadow-[0_4px_20px_rgba(0,0,0,0.02)] flex flex-col overflow-hidden">
            <div class="px-6 py-5 border-b border-slate-100 flex items-center justify-between bg-slate-50/50">
                <h3 class="text-sm font-bold text-slate-900">Validasi Data (Penting)</h3>
                <span class="px-2.5 py-1 bg-slate-200 text-slate-700 text-[10px] font-bold rounded-lg">3 Menunggu</span>
            </div>
            <div class="p-2 flex-1 flex flex-col gap-1">
                
                <!-- Item Validasi -->
                <div class="flex items-center justify-between p-4 hover:bg-slate-50 rounded-2xl transition-colors border border-transparent hover:border-slate-100">
                    <div class="flex items-center gap-4">
                        <div class="w-10 h-10 rounded-full bg-blue-50 text-blue-600 flex items-center justify-center shrink-0">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                        </div>
                        <div>
                            <p class="text-xs font-bold text-slate-900">Pendaftaran NIK Baru: Bima Satria</p>
                            <p class="text-[11px] font-medium text-slate-500 mt-0.5">Posyandu Mawar (RW 03)</p>
                        </div>
                    </div>
                    <div class="flex gap-2">
                        <button class="px-3 py-1.5 text-[10px] font-bold text-white bg-blue-600 rounded-lg hover:bg-blue-700 transition-colors">Setujui</button>
                        <button class="px-3 py-1.5 text-[10px] font-bold text-slate-500 bg-slate-100 rounded-lg hover:bg-slate-200 transition-colors">Cek</button>
                    </div>
                </div>

                <!-- Item Validasi 2 -->
                <div class="flex items-center justify-between p-4 hover:bg-slate-50 rounded-2xl transition-colors border border-transparent hover:border-slate-100">
                    <div class="flex items-center gap-4">
                        <div class="w-10 h-10 rounded-full bg-sky-50 text-sky-600 flex items-center justify-center shrink-0">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                        </div>
                        <div>
                            <p class="text-xs font-bold text-slate-900">Laporan Bulanan: Kader Siti</p>
                            <p class="text-[11px] font-medium text-slate-500 mt-0.5">Posyandu Melati - Status: Selesai</p>
                        </div>
                    </div>
                    <div class="flex gap-2">
                        <button class="px-3 py-1.5 text-[10px] font-bold text-blue-600 bg-blue-50 border border-blue-100 rounded-lg hover:bg-blue-100 transition-colors">Validasi Laporan</button>
                    </div>
                </div>

            </div>
            <div class="p-4 border-t border-slate-100">
                <button class="w-full py-2.5 text-xs font-bold text-slate-600 bg-white border border-slate-200 rounded-xl hover:bg-slate-50 transition-colors">Lihat Semua Tugas &rarr;</button>
            </div>
        </div>

        <!-- Panel 2: Jadwal Operasional Aktif -->
        <div class="rounded-3xl bg-white border border-slate-200/60 shadow-[0_4px_20px_rgba(0,0,0,0.02)] flex flex-col overflow-hidden">
            <div class="px-6 py-5 border-b border-slate-100 flex items-center justify-between bg-slate-50/50">
                <h3 class="text-sm font-bold text-slate-900">Jadwal Posyandu Mendatang</h3>
                <a href="#" class="text-[11px] font-bold text-blue-600 hover:underline">Kelola Kalender</a>
            </div>
            <div class="p-4 space-y-3 flex-1">
                
                <!-- Jadwal 1 -->
                <div class="flex items-stretch p-3 rounded-2xl border border-slate-200 hover:border-blue-300 transition-colors bg-white group">
                    <div class="flex flex-col justify-center items-center px-4 border-r border-slate-100">
                        <span class="text-xs font-bold text-slate-400">SEP</span>
                        <span class="text-2xl font-extrabold text-blue-600">12</span>
                    </div>
                    <div class="pl-4 py-1 flex-1 flex flex-col justify-center">
                        <h4 class="text-sm font-bold text-slate-900">Posyandu Mawar (RW 03)</h4>
                        <p class="text-xs font-medium text-slate-500 mt-0.5">Pemeriksaan Balita & Imunisasi</p>
                        <div class="mt-2 inline-flex items-center gap-1.5 text-[10px] font-bold text-slate-500">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            08:00 WIB
                        </div>
                    </div>
                    <div class="pr-2 flex items-center">
                        <button class="p-2 rounded-xl text-slate-400 hover:bg-blue-50 hover:text-blue-600 transition-colors" title="Buka Detail">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                        </button>
                    </div>
                </div>

                <!-- Jadwal 2 -->
                <div class="flex items-stretch p-3 rounded-2xl border border-slate-200 hover:border-blue-300 transition-colors bg-white group">
                    <div class="flex flex-col justify-center items-center px-4 border-r border-slate-100">
                        <span class="text-xs font-bold text-slate-400">SEP</span>
                        <span class="text-2xl font-extrabold text-slate-700 group-hover:text-blue-600 transition-colors">15</span>
                    </div>
                    <div class="pl-4 py-1 flex-1 flex flex-col justify-center">
                        <h4 class="text-sm font-bold text-slate-900">Posyandu Melati (RW 05)</h4>
                        <p class="text-xs font-medium text-slate-500 mt-0.5">Posbindu Lansia Terpadu</p>
                        <div class="mt-2 inline-flex items-center gap-1.5 text-[10px] font-bold text-slate-500">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            09:00 WIB
                        </div>
                    </div>
                    <div class="pr-2 flex items-center">
                        <button class="p-2 rounded-xl text-slate-400 hover:bg-blue-50 hover:text-blue-600 transition-colors" title="Buka Detail">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                        </button>
                    </div>
                </div>

            </div>
        </div>

    </div>
</div>

<style>
    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(12px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .animate-fade-in-up { animation: fadeInUp 0.4s cubic-bezier(0.16, 1, 0.3, 1) forwards; }
</style>

<!-- Script Alpine.js untuk Jam Dinamis -->
<script>
    function timeWidget() {
        return {
            dateText: '',
            timeText: '',
            init() {
                this.updateTime();
                setInterval(() => this.updateTime(), 1000);
            },
            updateTime() {
                const now = new Date();
                // Format Tanggal: Senin, 31 Agustus 2026
                this.dateText = now.toLocaleDateString('id-ID', { weekday: 'long', day: 'numeric', month: 'long', year: 'numeric' });
                // Format Waktu: 13:45:06
                this.timeText = now.toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit', second: '2-digit' }).replace(/\./g, ':');
            }
        }
    }
</script>
@endsection