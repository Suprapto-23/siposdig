@extends('layouts.app-admin')
@section('title', 'Edukasi Kesehatan - SIPOSDIG')

@section('content')
<div class="space-y-6 pb-8 animate-fade-in-up mt-4">
    <!-- Header Terpadu -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 bg-white p-6 rounded-[24px] border border-slate-200/60 shadow-sm relative overflow-hidden">
        <div class="absolute -right-10 -top-10 w-48 h-48 rounded-full bg-blue-50/60 blur-3xl z-0 pointer-events-none"></div>
        <div class="relative z-10">
            <h1 class="font-display text-2xl font-bold text-slate-900 tracking-tight">Edukasi Kesehatan</h1>
            <p class="text-[13px] text-slate-500 mt-1">Kelola publikasi materi kesehatan, panduan gizi, dan info posyandu warga.</p>
        </div>
        <a href="{{ route('admin.edukasi.create') }}" class="relative z-10 inline-flex items-center justify-center gap-2 rounded-xl bg-blue-600 px-6 py-3 text-[13px] font-bold text-white shadow-md shadow-blue-600/20 hover:bg-blue-700 transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            Tulis Artikel Baru
        </a>
    </div>

    <!-- Tabel Data Premium -->
    <div class="bg-white rounded-[24px] border border-slate-200/60 shadow-sm overflow-hidden">
        <div class="overflow-x-auto custom-scrollbar">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-100">
                        <th class="py-4 px-6 text-[11px] font-bold text-slate-400 uppercase tracking-wider">Judul Artikel</th>
                        <th class="py-4 px-6 text-[11px] font-bold text-slate-400 uppercase tracking-wider">Target Kategori</th>
                        <th class="py-4 px-6 text-[11px] font-bold text-slate-400 uppercase tracking-wider text-center">Tanggal Publikasi</th>
                        <th class="py-4 px-6 text-[11px] font-bold text-slate-400 uppercase tracking-wider text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($edukasis as $item)
                    <tr class="hover:bg-slate-50/50 transition-colors group">
                        <td class="py-4 px-6">
                            <p class="text-[13px] font-bold text-slate-900 group-hover:text-blue-600 transition-colors max-w-sm truncate">{{ $item->judul }}</p>
                        </td>
                        <td class="py-4 px-6">
                            <span class="inline-flex items-center px-3 py-1 rounded-lg bg-blue-50/50 text-blue-700 text-[11px] font-bold border border-blue-100">
                                <span class="w-1.5 h-1.5 rounded-full bg-blue-500 mr-2"></span>
                                {{ $item->target_kategori }}
                            </span>
                        </td>
                        <td class="py-4 px-6 text-center">
                            <p class="text-[12px] font-medium text-slate-600">{{ $item->created_at->format('d M Y') }}</p>
                        </td>
                        <td class="py-4 px-6 text-right space-x-2">
                            <a href="{{ route('admin.edukasi.show', $item->id) }}" class="inline-flex items-center justify-center p-2 rounded-xl text-slate-400 hover:bg-blue-50 hover:text-blue-600 transition-colors" title="Lihat">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                            </a>
                            <a href="{{ route('admin.edukasi.edit', $item->id) }}" class="inline-flex items-center justify-center p-2 rounded-xl text-slate-400 hover:bg-sky-50 hover:text-sky-600 transition-colors" title="Edit">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                            </a>
                            <form action="{{ route('admin.edukasi.destroy', $item->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Anda yakin ingin menghapus artikel ini?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="inline-flex items-center justify-center p-2 rounded-xl text-slate-400 hover:bg-red-50 hover:text-red-600 transition-colors" title="Hapus">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="py-12 text-center">
                            <div class="inline-flex flex-col items-center justify-center text-slate-400">
                                <svg class="w-12 h-12 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                                <span class="text-[13px] font-semibold">Belum ada artikel edukasi yang dipublikasikan.</span>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($edukasis->hasPages())
        <div class="p-4 border-t border-slate-100 bg-slate-50">
            {{ $edukasis->links() }}
        </div>
        @endif
    </div>
</div>
@endsection