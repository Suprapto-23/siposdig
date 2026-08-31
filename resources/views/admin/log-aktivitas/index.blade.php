@extends('layouts.app-admin')
@section('title', 'Log Aktivitas Sistem - SIPOSDIG')

@section('content')
<div class="space-y-6 pb-12 animate-fade-in-up mt-4 max-w-5xl mx-auto">
    
    <!-- Header Terpadu -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 bg-white p-6 rounded-[24px] border border-slate-200/60 shadow-sm relative overflow-hidden">
        <div class="absolute -right-10 -bottom-10 w-48 h-48 rounded-full bg-blue-50/60 blur-3xl z-0 pointer-events-none"></div>
        <div class="relative z-10">
            <h1 class="font-display text-2xl font-bold text-slate-900 tracking-tight">Log Aktivitas Sistem</h1>
            <p class="text-[13px] text-slate-500 mt-1">Pantau seluruh riwayat aktivitas admin, kader, dan warga secara real-time.</p>
        </div>
        
        <div class="flex items-center gap-3 relative z-10">
            <!-- Form Pencarian -->
            <form action="{{ route('admin.log-aktivitas') }}" method="GET" class="relative">
                <input type="text" name="cari" value="{{ request('cari') }}" placeholder="Cari pelaku atau aksi..." class="w-64 rounded-xl border border-slate-200 bg-slate-50/50 py-2.5 pl-10 pr-4 text-[13px] font-medium text-slate-800 focus:border-blue-500 focus:bg-white focus:outline-none focus:ring-4 focus:ring-blue-500/10 transition-all">
                <svg class="absolute left-3.5 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
            </form>

            <!-- Tombol Bersihkan Log -->
            <form action="{{ route('admin.log-aktivitas.clear') }}" method="POST" onsubmit="return confirm('Anda yakin ingin membersihkan SELURUH riwayat aktivitas? Tindakan ini tidak bisa dibatalkan.')">
                @csrf @method('DELETE')
                <button type="submit" class="inline-flex items-center justify-center gap-2 rounded-xl bg-white border border-slate-200 px-4 py-2.5 text-[13px] font-bold text-slate-600 shadow-sm hover:bg-red-50 hover:text-red-600 hover:border-red-200 transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                    Bersihkan
                </button>
            </form>
        </div>
    </div>

    <!-- Timeline Aktivitas Premium -->
    <div class="bg-white rounded-[24px] border border-slate-200/60 shadow-sm overflow-hidden p-2">
        <div class="flex flex-col">
            @forelse($logs as $log)
            <div class="flex items-start gap-4 p-4 hover:bg-slate-50 rounded-2xl transition-colors border border-transparent hover:border-slate-100 group">
                
                <!-- Ikon Berdasarkan Role -->
                <div class="shrink-0 flex items-center justify-center w-12 h-12 rounded-2xl 
                    {{ $log->role === 'Admin' ? 'bg-blue-600 text-white shadow-md shadow-blue-500/20' : 
                      ($log->role === 'Kader' ? 'bg-sky-100 text-sky-600' : 'bg-slate-100 text-slate-500') }}">
                    <span class="font-display font-bold text-lg">{{ substr($log->pelaku, 0, 1) }}</span>
                </div>

                <!-- Konten Aktivitas -->
                <div class="flex-1 min-w-0 pt-1">
                    <div class="flex items-center justify-between gap-4">
                        <div class="flex items-center gap-2">
                            <h3 class="text-[14px] font-bold text-slate-900">{{ $log->pelaku }}</h3>
                            <span class="inline-flex px-2 py-0.5 rounded-md text-[10px] font-bold uppercase tracking-wide
                                {{ $log->role === 'Admin' ? 'bg-blue-50 text-blue-700' : 
                                  ($log->role === 'Kader' ? 'bg-sky-50 text-sky-700' : 'bg-slate-100 text-slate-600') }}">
                                {{ $log->role }}
                            </span>
                        </div>
                        <span class="text-[11px] font-semibold text-slate-400 shrink-0">{{ $log->created_at->diffForHumans() }}</span>
                    </div>
                    
                    <p class="text-[13px] font-medium text-slate-600 mt-1">
                        Melakukan tindakan <span class="font-bold text-blue-600">{{ $log->aksi }}</span>: 
                        {{ $log->deskripsi }}
                    </p>
                </div>
            </div>
            @empty
            <div class="p-12 text-center flex flex-col items-center justify-center text-slate-400">
                <svg class="w-12 h-12 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                <span class="text-[13px] font-semibold">Belum ada riwayat aktivitas yang tercatat.</span>
            </div>
            @endforelse
        </div>
        
        <!-- Pagination -->
        @if($logs->hasPages())
        <div class="p-4 border-t border-slate-100 bg-slate-50 mt-2 rounded-xl mx-2 mb-2">
            {{ $logs->links() }}
        </div>
        @endif
    </div>

</div>
@endsection