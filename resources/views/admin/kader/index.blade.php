@extends('layouts.app-admin')

@section('title', 'Kelola Kader - SIPOSDIG')

@section('content')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<div class="w-full max-w-7xl mx-auto space-y-6">

    <!-- Header & Action Section -->
    <div class="flex flex-col md:flex-row md:items-end justify-between gap-4 bg-white p-6 rounded-3xl border border-slate-200/60 shadow-sm relative z-20">
        <div>
            <h1 class="font-display text-2xl font-bold text-slate-900 tracking-tight">Kelola Data Kader</h1>
            <p class="text-sm text-slate-500 mt-1">Manajemen akun petugas kader, penempatan unit posyandu, dan status aktif.</p>
        </div>
        
        <div class="flex flex-col sm:flex-row items-center gap-3 w-full md:w-auto">
            <!-- Search -->
            <form action="{{ route('admin.kader.index') }}" method="GET" class="relative w-full sm:w-64">
                <svg class="w-5 h-5 absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari Nama atau Email..." class="pl-10 pr-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-blue-600 focus:border-transparent outline-none w-full transition-all text-slate-700">
            </form>

            <!-- Tombol Tambah Kader -->
            <a href="{{ route('admin.kader.create') }}" class="w-full sm:w-auto flex items-center justify-center gap-2 py-2.5 px-5 bg-blue-600 hover:bg-blue-700 text-white rounded-xl text-sm font-bold transition-all shadow-sm shadow-blue-600/20">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                Tambah Kader Baru
            </a>
        </div>
    </div>

    <!-- Tabel Data Kader -->
    <div class="bg-white rounded-3xl border border-slate-200/60 shadow-sm overflow-hidden">
        <div class="overflow-x-auto custom-scrollbar">
            <table class="w-full text-left border-collapse min-w-[800px]">
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-200 text-[11px] uppercase tracking-widest text-slate-500 font-bold">
                        <th class="px-6 py-4">Profil Kader</th>
                        <th class="px-6 py-4">Penempatan Unit</th>
                        <th class="px-6 py-4">Tanggal Bergabung</th>
                        <th class="px-6 py-4">Status</th>
                        <th class="px-6 py-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-sm">
                    @forelse($kaders ?? [] as $kader)
                    <tr class="hover:bg-slate-50/50 transition-colors group">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center font-bold font-display border border-blue-200">
                                    {{ substr($kader->nama_lengkap, 0, 1) }}
                                </div>
                                <div>
                                    <div class="font-bold text-slate-900">{{ $kader->nama_lengkap }}</div>
                                    <div class="text-xs text-slate-500 mt-0.5">{{ $kader->email }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-slate-900 font-medium">{{ $kader->unitPosyandu->nama ?? 'Belum ada unit' }}</div>
                            <div class="text-xs text-slate-500 mt-0.5">{{ $kader->unitPosyandu->wilayah ?? '-' }}</div>
                        </td>
                        <td class="px-6 py-4 text-slate-600 tabular-nums text-xs">
                            {{ $kader->created_at->format('d M Y') }}
                        </td>
                        <td class="px-6 py-4">
                            @if($kader->status == 'aktif')
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md text-xs font-bold bg-emerald-50 text-emerald-700 border border-emerald-200/50">
                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> Aktif
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md text-xs font-bold bg-slate-100 text-slate-600 border border-slate-200">
                                    <span class="w-1.5 h-1.5 rounded-full bg-slate-400"></span> Nonaktif
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center justify-center gap-2">
                                <a href="{{ route('admin.kader.edit', $kader->id) }}" title="Edit Kader" class="p-2 text-blue-600 bg-blue-50 hover:bg-blue-100 rounded-xl transition-colors border border-blue-100">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/></svg>
                                </a>
                                <!-- Tambahkan form penghapusan/nonaktif di sini -->
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-12 text-center">
                            <div class="flex flex-col items-center justify-center text-slate-400">
                                <svg class="w-12 h-12 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                                <p class="font-bold text-slate-600">Belum ada data kader</p>
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