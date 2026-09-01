@extends('layouts.app-kader')
@section('title', 'Rincian Kehadiran - SIPOSDIG')
@section('content')
<div class="space-y-6 pb-8 animate-fade-in-up">

    <!-- Header dengan Tombol Kembali Premium -->
    <div class="flex items-center gap-4 mb-2">
        <a href="{{ route('kader.absensi.index') }}" class="w-11 h-11 flex items-center justify-center bg-white border border-slate-200 rounded-2xl text-slate-400 hover:text-blue-600 hover:bg-blue-50 hover:border-blue-200 transition-all shadow-sm focus:outline-none hover:-translate-x-1">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/></svg>
        </a>
        <div>
            <h2 class="font-jakarta text-2xl font-extrabold text-slate-800 tracking-tight">Detail Kehadiran <span class="text-blue-600">{{ $kategori }}</span></h2>
            <p class="text-[13px] text-slate-500 font-bold mt-0.5">Kegiatan Posyandu: {{ \Carbon\Carbon::parse($tanggal)->locale('id')->isoFormat('dddd, D MMMM YYYY') }}</p>
        </div>
    </div>

    <!-- SUMMARY CARDS (Statistik Rapi) -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
        <!-- Card Total -->
        <div class="bg-white rounded-[1.5rem] p-5 border border-slate-100 shadow-[0_4px_20px_-10px_rgba(0,0,0,0.05)] flex items-center gap-4">
            <div class="w-14 h-14 rounded-2xl bg-slate-50 flex items-center justify-center text-slate-500 border border-slate-100">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
            </div>
            <div>
                <p class="text-[11px] font-extrabold text-slate-400 uppercase tracking-widest mb-0.5">Total Warga</p>
                <p class="text-2xl font-black text-slate-800">{{ $statistik['total'] }} <span class="text-sm font-bold text-slate-400">Orang</span></p>
            </div>
        </div>
        
        <!-- Card Hadir -->
        <div class="bg-white rounded-[1.5rem] p-5 border border-blue-50 shadow-[0_4px_20px_-10px_rgba(37,99,235,0.08)] flex items-center gap-4">
            <div class="w-14 h-14 rounded-2xl bg-blue-50 flex items-center justify-center text-blue-600 border border-blue-100">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
            <div>
                <p class="text-[11px] font-extrabold text-blue-400 uppercase tracking-widest mb-0.5">Berhasil Hadir</p>
                <p class="text-2xl font-black text-blue-700">{{ $statistik['hadir'] }} <span class="text-sm font-bold text-blue-400">Orang</span></p>
            </div>
        </div>

        <!-- Card Tidak Hadir -->
        <div class="bg-white rounded-[1.5rem] p-5 border border-rose-50 shadow-[0_4px_20px_-10px_rgba(244,63,94,0.08)] flex items-center gap-4">
            <div class="w-14 h-14 rounded-2xl bg-rose-50 flex items-center justify-center text-rose-500 border border-rose-100">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
            <div>
                <p class="text-[11px] font-extrabold text-rose-400 uppercase tracking-widest mb-0.5">Tidak Hadir</p>
                <p class="text-2xl font-black text-rose-600">{{ $statistik['tidak_hadir'] }} <span class="text-sm font-bold text-rose-400">Orang</span></p>
            </div>
        </div>
    </div>

    <!-- Container Pencarian & Tabel Terintegrasi -->
    <div class="bg-white/80 backdrop-blur-xl border border-slate-100 rounded-[2rem] shadow-[0_8px_30px_rgba(37,99,235,0.04)] overflow-hidden relative z-10">
        
        <!-- Search Panel Tunggal (Lebih Rapi) -->
        <div class="p-5 border-b border-slate-100 bg-slate-50/50">
            <form method="GET" action="{{ route('kader.absensi.detail', $tanggal) }}" class="flex w-full relative">
                <!-- Hidden input mempertahankan kategori saat fitur pencarian diketik -->
                <input type="hidden" name="kategori" value="{{ $kategori }}">
                
                <div class="relative w-full sm:max-w-md">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    </div>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Pencarian spesifik (Nama atau NIK)..." 
                           class="block w-full pl-11 pr-4 py-3 bg-white border border-slate-200 focus:border-blue-500 focus:ring-4 focus:ring-blue-50 rounded-xl text-sm font-medium text-slate-800 transition-all shadow-sm outline-none">
                    <button type="submit" class="hidden"></button>
                </div>
            </form>
        </div>

        <!-- Table Rincian Warga -->
        <div class="overflow-x-auto custom-scrollbar">
            <table class="w-full text-left border-collapse min-w-[700px]">
                <thead>
                    <tr class="bg-white border-b border-slate-100 text-[11px] uppercase tracking-widest font-bold text-slate-400">
                        <th class="px-6 py-4 whitespace-nowrap w-[40%]">Profil Warga</th>
                        <th class="px-6 py-4 whitespace-nowrap w-[20%] text-center">Status Kehadiran</th>
                        <th class="px-6 py-4 whitespace-nowrap w-[40%]">Keterangan / Alasan</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100/80">
                    @forelse($absensi as $item)
                    <tr class="hover:bg-blue-50/20 transition-colors group">
                        <!-- Kolom 1: Profil -->
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center gap-4">
                                <div class="w-11 h-11 rounded-2xl bg-gradient-to-br from-slate-50 to-slate-100 border border-slate-200 flex items-center justify-center text-slate-600 font-extrabold shrink-0 shadow-sm text-lg">
                                    {{ substr($item->warga->nama_lengkap ?? 'U', 0, 1) }}
                                </div>
                                <div>
                                    <p class="text-sm font-bold text-slate-800 leading-tight">{{ $item->warga->nama_lengkap }}</p>
                                    <p class="text-[11px] font-semibold text-slate-400 mt-1">NIK: <span class="font-mono text-slate-500">{{ $item->warga->nik }}</span></p>
                                </div>
                            </div>
                        </td>
                        
                        <!-- Kolom 2: Status -->
                        <td class="px-6 py-4 whitespace-nowrap text-center">
                            @if($item->status_hadir === 'hadir') 
                                <span class="inline-flex items-center justify-center gap-1.5 px-3 py-1.5 rounded-xl bg-blue-50 text-blue-700 border border-blue-100 text-xs font-bold w-24">
                                    <span class="w-1.5 h-1.5 rounded-full bg-blue-500"></span> Hadir
                                </span>
                            @else 
                                <span class="inline-flex items-center justify-center gap-1.5 px-3 py-1.5 rounded-xl bg-rose-50 text-rose-700 border border-rose-100 text-xs font-bold w-24" title="{{ ucfirst($item->status_hadir) }}">
                                    <span class="w-1.5 h-1.5 rounded-full bg-rose-500"></span> Tdk Hadir
                                </span>
                            @endif
                        </td>

                        <!-- Kolom 3: Keterangan -->
                        <td class="px-6 py-4">
                            <span class="text-xs font-medium text-slate-500 line-clamp-2">
                                {{ $item->keterangan ?? '-' }}
                            </span>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="px-6 py-16 text-center">
                            <div class="flex flex-col items-center justify-center">
                                <div class="w-16 h-16 bg-slate-50 border border-slate-100 rounded-full flex items-center justify-center mb-4">
                                    <svg class="w-8 h-8 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                                </div>
                                <p class="text-sm font-bold text-slate-600">Tidak ada warga yang sesuai pencarian.</p>
                                <a href="{{ route('kader.absensi.detail', $tanggal) }}?kategori={{ $kategori }}" class="mt-2 text-xs font-bold text-blue-500 hover:text-blue-600 transition-colors">Reset Pencarian</a>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <!-- Pagination -->
        @if($absensi->hasPages()) 
        <div class="px-6 py-4 border-t border-slate-100 bg-white premium-pagination">
            {{ $absensi->links() }}
        </div> 
        @endif
    </div>
</div>

<style>
    /* Styling khusus Pagination Premium */
    .premium-pagination nav p { display: none; }
    .premium-pagination nav div.hidden.sm\:flex-1 { display: flex !important; justify-content: center !important; }
    .premium-pagination nav span.relative.inline-flex.items-center { border-radius: 12px; overflow: hidden; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05); }
    .premium-pagination nav a, .premium-pagination nav span[aria-disabled] { padding: 10px 16px !important; font-size: 13px !important; font-weight: 700 !important; color: #64748b; background-color: #ffffff; border-color: #f1f5f9; transition: all 0.2s; }
    .premium-pagination nav a:hover { background-color: #eff6ff; color: #2563eb; }
    .premium-pagination nav span[aria-current="page"] span { background-color: #3b82f6 !important; color: #ffffff !important; border-color: #3b82f6 !important; }
</style>
@endsection