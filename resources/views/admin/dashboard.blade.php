@extends('layouts.app-admin')
@section('title', 'Dashboard Administrator - SIPOSDIG')

@section('content')
<div class="space-y-6 animate-fade-in-up">

    <!-- Header Dashboard -->
    <div class="bg-white/80 backdrop-blur-2xl border border-white p-6 rounded-[2rem] shadow-[0_8px_30px_rgba(37,99,235,0.04)]">
        <h2 class="font-jakarta text-2xl font-black text-slate-800 tracking-tight">Ikhtisar Operasional</h2>
        <p class="text-[13px] text-slate-500 font-medium mt-1">Pantau statistik utama dan aktivitas terbaru di sistem SIPOSDIG hari ini.</p>
    </div>

    <!-- Grid Statistik 4 Kolom -->
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-4 md:gap-6">
        
        <!-- Total Warga -->
        <div class="bg-gradient-to-br from-blue-500 to-sky-400 rounded-[2rem] p-6 shadow-[0_10px_30px_rgba(59,130,246,0.3)] relative overflow-hidden text-white">
            <div class="absolute top-0 right-0 -mt-4 -mr-4 w-24 h-24 bg-white/20 rounded-full blur-xl"></div>
            <div class="w-12 h-12 bg-white/20 rounded-2xl flex items-center justify-center mb-4 backdrop-blur-sm border border-white/30">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
            </div>
            <p class="text-[11px] font-black uppercase tracking-widest text-blue-50">Total Warga Binaan</p>
            <h3 class="text-4xl font-black mt-1">{{ $totalWarga }} <span class="text-sm font-bold text-blue-100 normal-case">Jiwa</span></h3>
        </div>

        <!-- Antrean Verifikasi -->
        <div class="bg-white/80 backdrop-blur-2xl border border-white rounded-[2rem] p-6 shadow-[0_8px_30px_rgba(37,99,235,0.04)]">
            <div class="w-12 h-12 bg-amber-50 text-amber-500 rounded-2xl flex items-center justify-center mb-4">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
            </div>
            <p class="text-[11px] font-extrabold uppercase tracking-widest text-slate-400">Antrean Verifikasi</p>
            <h3 class="text-3xl font-black text-slate-800 mt-1">{{ $wargaPending }} <span class="text-sm font-bold text-slate-400 normal-case">Akun</span></h3>
        </div>

        <!-- Total Kader -->
        <div class="bg-white/80 backdrop-blur-2xl border border-white rounded-[2rem] p-6 shadow-[0_8px_30px_rgba(37,99,235,0.04)]">
            <div class="w-12 h-12 bg-emerald-50 text-emerald-500 rounded-2xl flex items-center justify-center mb-4">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
            </div>
            <p class="text-[11px] font-extrabold uppercase tracking-widest text-slate-400">Petugas Kader</p>
            <h3 class="text-3xl font-black text-slate-800 mt-1">{{ $totalKader }} <span class="text-sm font-bold text-slate-400 normal-case">Orang</span></h3>
        </div>

        <!-- Total Posyandu -->
        <div class="bg-white/80 backdrop-blur-2xl border border-white rounded-[2rem] p-6 shadow-[0_8px_30px_rgba(37,99,235,0.04)]">
            <div class="w-12 h-12 bg-purple-50 text-purple-500 rounded-2xl flex items-center justify-center mb-4">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
            </div>
            <p class="text-[11px] font-extrabold uppercase tracking-widest text-slate-400">Unit Posyandu</p>
            <h3 class="text-3xl font-black text-slate-800 mt-1">{{ $totalPosyandu }} <span class="text-sm font-bold text-slate-400 normal-case">Titik</span></h3>
        </div>
    </div>

    <!-- Pendaftar Warga Terbaru (Tabel) -->
    <div class="bg-white/90 backdrop-blur-2xl border border-slate-100 rounded-[2rem] shadow-[0_8px_30px_rgba(37,99,235,0.04)] p-6">
        <div class="flex items-center justify-between mb-6">
            <h3 class="text-base font-black text-slate-800">Pendaftaran Warga Terbaru</h3>
            <a href="{{ route('admin.warga.index') }}" class="text-xs font-bold text-blue-600 hover:text-blue-700 transition-colors">Lihat Semua &rarr;</a>
        </div>

        <div class="overflow-x-auto custom-scrollbar">
            <table class="w-full text-left border-collapse min-w-[700px]">
                <thead>
                    <tr class="border-b border-slate-100 text-[10px] uppercase tracking-widest font-extrabold text-slate-400">
                        <th class="pb-3 pr-4">Nama Lengkap & NIK</th>
                        <th class="pb-3 px-4">Unit Posyandu</th>
                        <th class="pb-3 px-4 text-center">Status</th>
                        <th class="pb-3 pl-4 text-right">Terdaftar</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100/80">
                    @forelse($warga as $item)
                    <tr class="hover:bg-slate-50/50 transition-colors">
                        <td class="py-4 pr-4">
                            <p class="text-sm font-bold text-slate-800">{{ $item->nama_lengkap }}</p>
                            <p class="text-[11px] font-bold text-slate-400 font-mono mt-0.5">{{ $item->nik }}</p>
                        </td>
                        <td class="py-4 px-4">
                            <p class="text-xs font-bold text-slate-700">{{ $item->unitPosyandu->nama ?? 'Tidak terikat' }}</p>
                        </td>
                        <td class="py-4 px-4 text-center">
                            @if($item->status == 'pending')
                                <span class="px-2.5 py-1 bg-amber-50 text-amber-600 border border-amber-200 rounded-lg text-[10px] font-extrabold uppercase">Tertunda</span>
                            @elseif($item->status == 'aktif')
                                <span class="px-2.5 py-1 bg-emerald-50 text-emerald-600 border border-emerald-200 rounded-lg text-[10px] font-extrabold uppercase">Aktif</span>
                            @else
                                <span class="px-2.5 py-1 bg-slate-100 text-slate-500 border border-slate-200 rounded-lg text-[10px] font-extrabold uppercase">Nonaktif</span>
                            @endif
                        </td>
                        <td class="py-4 pl-4 text-right">
                            <p class="text-xs font-bold text-slate-600">{{ $item->created_at->diffForHumans() }}</p>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="py-8 text-center text-xs font-bold text-slate-400">Belum ada data warga terdaftar.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection