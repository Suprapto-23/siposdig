@extends('layouts.app-admin')

@section('title', 'Kelola Warga - SIPOSDIG')

@section('content')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<div class="w-full max-w-7xl mx-auto space-y-6">
    <!-- Header & Action -->
    <div class="flex flex-col md:flex-row md:items-end justify-between gap-4 bg-white p-6 rounded-3xl border border-slate-200/60 shadow-sm relative z-20">
        <div>
            <h1 class="font-display text-2xl font-bold text-slate-900 tracking-tight">Kelola Data Warga</h1>
            <p class="text-sm text-slate-500 mt-1">Manajemen data kependudukan, balita, remaja, hingga lansia binaan posyandu.</p>
        </div>
        
        <div class="flex flex-col sm:flex-row items-center gap-3 w-full md:w-auto">
            <form action="{{ route('admin.warga.index') }}" method="GET" class="relative w-full sm:w-64">
                <svg class="w-5 h-5 absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari NIK atau Nama..." class="pl-10 pr-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-blue-600 outline-none w-full text-slate-700">
            </form>

            <a href="{{ route('admin.warga.create') }}" class="w-full sm:w-auto flex items-center justify-center gap-2 py-2.5 px-5 bg-blue-600 hover:bg-blue-700 text-white rounded-xl text-sm font-bold shadow-sm shadow-blue-600/20 transition-all">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                Tambah Warga
            </a>
        </div>
    </div>

    <!-- Tabel Data Warga -->
    <div class="bg-white rounded-3xl border border-slate-200/60 shadow-sm overflow-hidden">
        <div class="overflow-x-auto custom-scrollbar">
            <table class="w-full text-left border-collapse min-w-[800px]">
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-200 text-[11px] uppercase tracking-widest text-slate-500 font-bold">
                        <th class="px-6 py-4">Nama Lengkap</th>
                        <th class="px-6 py-4">NIK</th>
                        <th class="px-6 py-4">Unit Posyandu & Alamat</th>
                        <th class="px-6 py-4">Status</th>
                        <th class="px-6 py-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-sm">
                    @forelse($wargas ?? [] as $warga)
                    <tr class="hover:bg-slate-50/50 transition-colors">
                        <td class="px-6 py-4">
                            <div class="font-bold text-slate-900">{{ $warga->nama_lengkap }}</div>
                            <div class="text-xs text-slate-500 mt-0.5">{{ $warga->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }} • {{ \Carbon\Carbon::parse($warga->tanggal_lahir)->age }} Tahun</div>
                        </td>
                        <td class="px-6 py-4">
                            <span class="font-mono text-slate-700 tabular-nums bg-slate-100 px-2.5 py-1 rounded-md text-xs border border-slate-200">{{ $warga->nik }}</span>
                        </td>
                        <td class="px-6 py-4">
                            <div class="font-medium text-slate-900">{{ $warga->unitPosyandu->nama ?? '-' }}</div>
                            <div class="text-xs text-slate-500 mt-0.5 truncate max-w-xs">{{ $warga->alamat }}</div>
                        </td>
                        <td class="px-6 py-4">
                            @if($warga->status == 'aktif')
                                <span class="px-2.5 py-1 rounded-md text-xs font-bold bg-emerald-50 text-emerald-700 border border-emerald-200">Aktif</span>
                            @elseif($warga->status == 'pending')
                                <span class="px-2.5 py-1 rounded-md text-xs font-bold bg-amber-50 text-amber-600 border border-amber-200">Pending</span>
                            @else
                                <span class="px-2.5 py-1 rounded-md text-xs font-bold bg-rose-50 text-rose-600 border border-rose-200">Nonaktif</span>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center justify-center gap-2">
                                <a href="{{ route('admin.warga.show', $warga->id) }}" title="Detail Warga" class="p-2 text-slate-500 bg-slate-50 hover:bg-blue-50 hover:text-blue-600 rounded-xl transition-colors border border-slate-100">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                </a>
                                <a href="{{ route('admin.warga.edit', $warga->id) }}" title="Edit Warga" class="p-2 text-blue-600 bg-blue-50 hover:bg-blue-100 rounded-xl transition-colors border border-blue-100">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/></svg>
                                </a>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-12 text-center text-slate-400">Belum ada data warga terdaftar.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if(isset($wargas) && $wargas->hasPages())
        <div class="px-6 py-4 border-t border-slate-100 bg-slate-50">
            {{ $wargas->links() }}
        </div>
        @endif
    </div>
</div>
@endsection