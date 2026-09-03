@extends('layouts.app-warga')
@section('title', 'Riwayat Kesehatan - SIPOSDIG')

@section('content')
<div class="space-y-6 lg:space-y-8 pb-40 animate-fade-in-up">

    <!-- HEADER HALAMAN -->
    <div class="bg-gradient-to-br from-blue-600 via-blue-500 to-sky-400 rounded-[2.5rem] p-8 shadow-[0_15px_40px_rgba(59,130,246,0.25)] relative overflow-hidden flex flex-col md:flex-row justify-between items-start md:items-center gap-6">
        <div class="absolute top-0 right-0 -mt-10 -mr-10 w-40 h-40 bg-white/10 rounded-full blur-2xl pointer-events-none"></div>
        <div class="absolute bottom-0 left-0 -mb-10 -ml-10 w-40 h-40 bg-white/10 rounded-full blur-3xl pointer-events-none"></div>
        
        <div class="relative z-10">
            <p class="text-blue-100 text-xs font-bold tracking-widest uppercase mb-2 flex items-center gap-2">
                <svg class="w-4 h-4 text-emerald-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                Rekam Medis Posyandu
            </p>
            <h2 class="text-3xl font-black text-white leading-tight">Riwayat Kesehatan</h2>
            <p class="text-blue-100 text-sm font-medium mt-2 max-w-md">Pantau rekam jejak pertumbuhan dan hasil pemeriksaan fisik Anda dari waktu ke waktu secara detail.</p>
        </div>
        
        <div class="relative z-10 bg-white/20 backdrop-blur-md border border-white/30 rounded-2xl p-4 flex items-center gap-4 shrink-0">
            <div class="w-12 h-12 bg-white text-blue-600 rounded-xl flex items-center justify-center font-black text-xl shadow-sm">
                {{ $riwayat->total() }}
            </div>
            <div>
                <p class="text-white text-xs font-bold uppercase tracking-wider">Total</p>
                <p class="text-blue-50 text-[10px] font-medium mt-0.5">Pemeriksaan</p>
            </div>
        </div>
    </div>

    <!-- DAFTAR RIWAYAT (TIMELINE CARDS) -->
    <div class="space-y-5 lg:space-y-6 relative">
        <!-- Garis Timeline (Hanya terlihat di layar agak besar) -->
        <div class="hidden sm:block absolute left-8 top-8 bottom-8 w-1 bg-slate-100 rounded-full z-0"></div>

        @forelse($riwayat as $item)
            <div class="bg-white/90 backdrop-blur-2xl border border-slate-100 p-6 lg:p-8 rounded-[2rem] shadow-[0_8px_30px_rgba(37,99,235,0.04)] relative z-10 hover:shadow-[0_8px_30px_rgba(37,99,235,0.08)] transition-all">
                
                <!-- Header Kartu: Tanggal & Keterangan -->
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6 pb-6 border-b border-slate-100/80">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 rounded-2xl bg-blue-50 text-blue-500 flex items-center justify-center border border-blue-100 shrink-0 shadow-sm">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        </div>
                        <div>
                            <h4 class="text-base font-black text-slate-800">{{ \Carbon\Carbon::parse($item->tanggal_ukur)->translatedFormat('d F Y') }}</h4>
                            <p class="text-xs font-extrabold text-slate-400 uppercase tracking-widest mt-1">Pemeriksaan Posyandu</p>
                        </div>
                    </div>
                </div>

                <!-- Grid Data Pengukuran -->
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4 lg:gap-6">
                    <!-- Berat Badan -->
                    <div class="bg-amber-50/50 border border-amber-100 p-4 rounded-2xl">
                        <p class="text-[10px] lg:text-xs font-extrabold text-slate-400 uppercase tracking-widest mb-1.5">Berat Badan</p>
                        <p class="text-xl lg:text-2xl font-black text-slate-800">{{ $item->berat_badan ?? '-' }} <span class="text-xs font-bold text-slate-500">kg</span></p>
                    </div>
                    
                    <!-- Tinggi Badan -->
                    <div class="bg-sky-50/50 border border-sky-100 p-4 rounded-2xl">
                        <p class="text-[10px] lg:text-xs font-extrabold text-slate-400 uppercase tracking-widest mb-1.5">Tinggi Badan</p>
                        <p class="text-xl lg:text-2xl font-black text-slate-800">{{ $item->tinggi_badan ?? '-' }} <span class="text-xs font-bold text-slate-500">cm</span></p>
                    </div>

                    <!-- Lingkar Kepala (Jika Ada) -->
                    <div class="bg-purple-50/50 border border-purple-100 p-4 rounded-2xl">
                        <p class="text-[10px] lg:text-xs font-extrabold text-slate-400 uppercase tracking-widest mb-1.5">Lingkar Kepala</p>
                        <p class="text-xl lg:text-2xl font-black text-slate-800">{{ $item->lingkar_kepala ?? '-' }} <span class="text-xs font-bold text-slate-500">cm</span></p>
                    </div>

                    <!-- Lingkar Lengan (Jika Ada) -->
                    <div class="bg-emerald-50/50 border border-emerald-100 p-4 rounded-2xl">
                        <p class="text-[10px] lg:text-xs font-extrabold text-slate-400 uppercase tracking-widest mb-1.5">Lingkar Lengan</p>
                        <p class="text-xl lg:text-2xl font-black text-slate-800">{{ $item->lingkar_lengan ?? '-' }} <span class="text-xs font-bold text-slate-500">cm</span></p>
                    </div>
                </div>

                <!-- Catatan / Saran Tambahan (Jika ada di database) -->
                @if(!empty($item->catatan))
                <div class="mt-6 pt-5 border-t border-slate-100/80">
                    <p class="text-[10px] font-extrabold text-slate-400 uppercase tracking-widest mb-2 flex items-center gap-1.5">
                        <svg class="w-3.5 h-3.5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        Catatan Petugas Kader
                    </p>
                    <p class="text-sm font-medium text-slate-600 leading-relaxed bg-slate-50 p-4 rounded-xl border border-slate-100">{{ $item->catatan }}</p>
                </div>
                @endif
            </div>
        @empty
            <!-- State Kosong -->
            <div class="bg-white/60 border-2 border-dashed border-slate-200 p-12 rounded-[2rem] flex flex-col items-center justify-center text-center relative z-10">
                <div class="w-20 h-20 bg-slate-100 rounded-3xl flex items-center justify-center text-slate-400 mb-5 shadow-inner">
                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                </div>
                <h3 class="text-lg font-black text-slate-700 mb-1">Belum Ada Riwayat</h3>
                <p class="text-sm font-medium text-slate-500 max-w-md mx-auto">Anda belum memiliki data riwayat pengukuran. Silakan hadir pada jadwal Posyandu terdekat untuk melakukan pemeriksaan.</p>
            </div>
        @endforelse

        <!-- Paginasi -->
        @if($riwayat->hasPages())
        <div class="mt-8 pt-4">
            {{ $riwayat->links() }}
        </div>
        @endif

    </div>
</div>
@endsection