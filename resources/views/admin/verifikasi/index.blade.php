@extends('layouts.app-admin')
@section('title', 'Verifikasi Akun Warga - SIPOSDIG')

@section('content')
<div class="space-y-6 pb-12 animate-fade-in-up">

    <!-- Header & Pencarian -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 bg-white/80 backdrop-blur-2xl border border-white p-6 rounded-[2rem] shadow-[0_8px_30px_rgba(37,99,235,0.04)]">
        <div>
            <h2 class="font-jakarta text-2xl font-black text-slate-800 tracking-tight">Verifikasi Akun Warga</h2>
            <p class="text-[13px] text-slate-500 font-medium mt-1">Kelola dan verifikasi pendaftaran akun warga baru sebelum diberikan akses sistem.</p>
        </div>
        
        <!-- Form Pencarian (Metode GET) -->
        <form method="GET" action="{{ route('admin.verifikasi.index') }}" class="flex w-full md:max-w-md relative">
            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400">
                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
            </div>
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari NIK atau Nama Pendaftar..." class="block w-full pl-11 pr-4 py-3 bg-slate-50 border border-slate-200 focus:bg-white focus:border-blue-400 focus:ring-4 focus:ring-blue-50 rounded-2xl text-sm font-medium text-slate-800 transition-all outline-none">
        </form>
    </div>

    <!-- Alert Sukses -->
    @if(session('success'))
        <div class="p-4 bg-emerald-50 border border-emerald-100 flex items-center gap-3 rounded-2xl shadow-sm">
            <div class="w-8 h-8 rounded-full bg-emerald-200/50 flex items-center justify-center text-emerald-600 shrink-0">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
            </div>
            <p class="text-sm font-bold text-emerald-700">{{ session('success') }}</p>
        </div>
    @endif

    <!-- Tabel Antrean Verifikasi -->
    <div class="bg-white/90 backdrop-blur-2xl border border-slate-100 rounded-[2rem] shadow-[0_8px_30px_rgba(37,99,235,0.04)] overflow-hidden">
        
        <div class="overflow-x-auto custom-scrollbar">
            <table class="w-full text-left border-collapse min-w-[900px]">
                <thead>
                    <tr class="bg-slate-50/50 border-b border-slate-100 text-[11px] uppercase tracking-widest font-extrabold text-slate-400">
                        <th class="px-6 py-4">Profil Pendaftar</th>
                        <th class="px-6 py-4 text-center">Kategori</th>
                        <th class="px-6 py-4">Unit Posyandu</th>
                        <th class="px-6 py-4 text-center">Tanggal Daftar</th>
                        <th class="px-6 py-4 text-right">Aksi Verifikasi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100/80">
                    @forelse($antrean as $item)
                    <tr class="hover:bg-blue-50/30 transition-colors">
                        <td class="px-6 py-4">
                            <p class="text-sm font-bold text-slate-800">{{ $item->nama_lengkap }}</p>
                            <p class="text-[11px] font-bold text-slate-400 font-mono mt-1">NIK: {{ $item->nik }}</p>
                        </td>
                        <td class="px-6 py-4 text-center">
                            @if($item->kategori == 'Balita')
                                <span class="px-3 py-1 bg-blue-50 text-blue-600 border border-blue-100 rounded-lg text-xs font-bold uppercase tracking-wider">Balita</span>
                            @elseif($item->kategori == 'Remaja')
                                <span class="px-3 py-1 bg-emerald-50 text-emerald-600 border border-emerald-100 rounded-lg text-xs font-bold uppercase tracking-wider">Remaja</span>
                            @else
                                <span class="px-3 py-1 bg-purple-50 text-purple-600 border border-purple-100 rounded-lg text-xs font-bold uppercase tracking-wider">Lansia</span>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            <p class="text-sm font-bold text-slate-700">
                                <!-- Silakan sesuaikan 'nama_posyandu' atau 'nama' berdasarkan kolom di database Anda -->
                                {{ $item->unitPosyandu->nama_posyandu ?? $item->unitPosyandu->nama ?? 'Tidak terikat unit' }}
                            </p>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <p class="text-sm font-bold text-slate-600">{{ $item->created_at->format('d M Y') }}</p>
                            <p class="text-[10px] font-bold text-slate-400 mt-1">{{ $item->created_at->format('H:i') }} WIB</p>
                        </td>
                        
                        <!-- KOLOM AKSI (Menggunakan FORM POST secara ketat) -->
                        <td class="px-6 py-4 text-right">
                            <div class="flex items-center justify-end gap-2">
                                
                                <!-- Tombol Setujui -->
                                <form action="{{ route('admin.verifikasi.setujui', $item->id) }}" method="POST" class="m-0">
    @csrf
    <button type="submit">Setujui</button>
</form>

                                <!-- Tombol Tolak -->
                                <form action="{{ route('admin.verifikasi.tolak', $item->id) }}" method="POST" class="m-0" onsubmit="return confirm('Apakah Anda yakin ingin menolak pendaftaran warga ini? Akun tidak akan bisa digunakan.');">
                                    @csrf
                                    <button type="submit" class="inline-flex items-center gap-1.5 px-4 py-2 bg-rose-50 hover:bg-rose-100 text-rose-600 font-bold text-xs rounded-xl transition-all focus:outline-none cursor-pointer">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                                        Tolak
                                    </button>
                                </form>

                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-16 text-center">
                            <div class="flex flex-col items-center justify-center">
                                <div class="w-16 h-16 bg-slate-50 border border-slate-100 rounded-full flex items-center justify-center mb-4">
                                    <svg class="w-8 h-8 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                </div>
                                <h3 class="text-base font-black text-slate-800">Tidak Ada Antrean</h3>
                                <p class="text-sm font-medium text-slate-500 mt-1">Saat ini tidak ada pendaftaran warga baru yang menunggu verifikasi.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($antrean->hasPages()) 
        <div class="px-6 py-4 border-t border-slate-100 bg-slate-50/50">
            {{ $antrean->links() }}
        </div> 
        @endif
        
    </div>
</div>
@endsection