@extends('layouts.app-kader')
@section('title', 'Catat Kehadiran Massal - SIPOSDIG')
@section('content')
<div class="w-full max-w-[1000px] mx-auto space-y-6 pb-8 animate-fade-in-up">

    <!-- Header -->
    <div class="flex items-center gap-4 mb-2">
        <a href="{{ route('kader.absensi.index') }}" class="p-2.5 bg-white border border-slate-200 rounded-xl text-slate-400 hover:text-blue-600 hover:bg-blue-50 transition-colors focus:outline-none shadow-sm">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
        </a>
        <div>
            <h2 class="font-jakarta text-2xl font-extrabold text-slate-800 tracking-tight">Catat Kehadiran Posyandu</h2>
            <p class="text-[13px] text-slate-500 font-medium mt-1">Pilih kategori dan input absensi warga secara massal dengan cepat.</p>
        </div>
    </div>

    <!-- Form Container -->
    <form method="POST" action="{{ route('kader.absensi.store') }}" 
          x-data="{ isSubmitting: false, searchQuery: '' }" 
          @submit="isSubmitting = true">
        @csrf

        <!-- Kotak Konfigurasi Atas -->
        <div class="bg-white/80 backdrop-blur-xl border border-slate-100 rounded-[2rem] p-6 shadow-[0_8px_30px_rgba(37,99,235,0.04)] mb-6 flex flex-col md:flex-row gap-6 items-center justify-between">
            <div class="w-full md:w-auto">
                <label class="block text-[11px] font-extrabold text-slate-400 mb-1.5 tracking-widest uppercase">Tanggal Kegiatan</label>
                <input type="date" name="tanggal" value="{{ date('Y-m-d') }}" required
                       class="block w-full md:w-48 px-4 py-2.5 bg-slate-50 border border-slate-200 focus:border-blue-500 focus:ring-4 focus:ring-blue-50 rounded-xl text-sm font-bold text-slate-800 transition-all outline-none shadow-inner">
            </div>

            <!-- Tab Kategori -->
            <div class="w-full md:w-auto flex bg-slate-100/80 p-1.5 rounded-2xl border border-slate-200/60 overflow-x-auto">
                <a href="{{ route('kader.absensi.create', ['kategori' => 'Balita']) }}" class="flex-1 whitespace-nowrap text-center px-5 py-2.5 rounded-xl text-sm font-bold transition-all {{ $kategoriAktif == 'Balita' ? 'bg-white text-blue-600 shadow-sm border border-slate-100' : 'text-slate-500 hover:text-slate-700' }}">👶 Balita</a>
                <a href="{{ route('kader.absensi.create', ['kategori' => 'Remaja']) }}" class="flex-1 whitespace-nowrap text-center px-5 py-2.5 rounded-xl text-sm font-bold transition-all {{ $kategoriAktif == 'Remaja' ? 'bg-white text-blue-600 shadow-sm border border-slate-100' : 'text-slate-500 hover:text-slate-700' }}">👧 Remaja</a>
                <a href="{{ route('kader.absensi.create', ['kategori' => 'Lansia']) }}" class="flex-1 whitespace-nowrap text-center px-5 py-2.5 rounded-xl text-sm font-bold transition-all {{ $kategoriAktif == 'Lansia' ? 'bg-white text-blue-600 shadow-sm border border-slate-100' : 'text-slate-500 hover:text-slate-700' }}">👴 Lansia</a>
            </div>
        </div>

        <!-- Tabel Bulk Input dengan UI Premium -->
        <div class="bg-white/90 backdrop-blur-xl border border-slate-100 rounded-[2rem] shadow-[0_8px_30px_rgba(37,99,235,0.05)] overflow-hidden">
            
            <!-- Header Table & Live Search -->
            <div class="px-6 py-5 border-b border-slate-100 bg-blue-50/30 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                <div>
                    <h3 class="font-jakarta font-extrabold text-slate-800 text-lg">Daftar Warga: <span class="text-blue-600">{{ $kategoriAktif }}</span></h3>
                    <p class="text-xs text-slate-500 mt-1 font-semibold">Total {{ $warga->count() }} orang di unit Anda.</p>
                </div>
                
                @if($warga->count() > 0)
                <div class="relative w-full sm:w-64">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400">
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    </div>
                    <input type="text" x-model="searchQuery" placeholder="Cari Nama Warga..." 
                           class="block w-full pl-9 pr-3 py-2 bg-white border border-slate-200 focus:border-blue-500 rounded-xl text-sm font-medium text-slate-800 transition-all outline-none shadow-sm">
                </div>
                @endif
            </div>

            @if($warga->count() > 0)
                <!-- Scrollable Area -->
                <div class="overflow-x-auto overflow-y-auto max-h-[65vh] custom-scrollbar">
                    <table class="w-full text-left border-collapse min-w-[700px]">
                        <thead class="sticky top-0 z-20 bg-slate-50/95 backdrop-blur-sm border-b border-slate-200">
                            <tr class="text-[11px] uppercase tracking-widest font-bold text-slate-400 shadow-sm">
                                <th class="px-6 py-4 w-[40%]">Profil Warga</th>
                                <th class="px-6 py-4 w-[25%] text-center">Kehadiran</th>
                                <th class="px-6 py-4 w-[35%]">Alasan / Keterangan</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @foreach($warga as $w)
                            <tr x-show="searchQuery === '' || '{{ strtolower($w->nama_lengkap) }}'.includes(searchQuery.toLowerCase()) || '{{ $w->nik }}'.includes(searchQuery)" 
                                class="hover:bg-blue-50/20 transition-colors">
                                
                                <!-- Kolom Profil (Avatar + Nama_Lengkap) -->
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <div class="w-11 h-11 rounded-2xl bg-gradient-to-br from-blue-50 to-sky-50 border border-blue-100 flex items-center justify-center text-blue-600 font-bold shrink-0 shadow-sm text-lg">
                                            {{ substr($w->nama_lengkap ?? 'U', 0, 1) }}
                                        </div>
                                        <div>
                                            <p class="text-sm font-bold text-slate-800 leading-tight">{{ $w->nama_lengkap }}</p>
                                            <p class="text-[11px] font-semibold text-slate-400 mt-1">NIK: <span class="font-mono text-slate-500">{{ $w->nik }}</span></p>
                                        </div>
                                    </div>
                                </td>

                                <!-- Kolom 2 Pilihan Status Saja -->
                                <td class="px-6 py-4">
                                    <div class="flex items-center justify-center gap-2">
                                        <!-- Hadir -->
                                        <label class="cursor-pointer relative flex-1 max-w-[100px]">
                                            <input type="radio" name="kehadiran[{{ $w->id }}][status]" value="hadir" class="peer sr-only" checked>
                                            <div class="px-2 py-2 border border-slate-200 rounded-xl peer-checked:bg-blue-50 peer-checked:border-blue-500 peer-checked:text-blue-700 text-slate-400 bg-white hover:bg-slate-50 transition-all text-center">
                                                <span class="text-xs font-bold">Hadir</span>
                                            </div>
                                        </label>
                                        <!-- Tidak Hadir (Disimpan sebagai 'izin' di DB) -->
                                        <label class="cursor-pointer relative flex-1 max-w-[100px]">
                                            <input type="radio" name="kehadiran[{{ $w->id }}][status]" value="izin" class="peer sr-only">
                                            <div class="px-2 py-2 border border-slate-200 rounded-xl peer-checked:bg-rose-50 peer-checked:border-rose-400 peer-checked:text-rose-600 text-slate-400 bg-white hover:bg-slate-50 transition-all text-center">
                                                <span class="text-xs font-bold">Tidak Hadir</span>
                                            </div>
                                        </label>
                                    </div>
                                </td>

                                <!-- Kolom Keterangan -->
                                <td class="px-6 py-4 pr-8">
                                    <input type="text" name="kehadiran[{{ $w->id }}][keterangan]" placeholder="Tulis alasan jika tidak hadir (sakit/alpa)..." 
                                           class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 focus:bg-white focus:border-blue-400 focus:ring-4 focus:ring-blue-50 rounded-xl text-xs font-medium text-slate-700 placeholder-slate-400 transition-all outline-none">
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Footer Submit -->
                <div class="px-6 py-5 bg-slate-50/80 border-t border-slate-100 flex justify-end relative z-30 shadow-[0_-10px_20px_-5px_rgba(0,0,0,0.02)]">
                    <button type="submit" :disabled="isSubmitting" class="bg-gradient-to-r from-blue-500 to-sky-500 hover:from-blue-600 hover:to-sky-500 text-white font-bold text-sm py-3.5 px-10 rounded-xl shadow-[0_8px_15px_-5px_rgba(37,99,235,0.4)] flex items-center gap-2 transition-all hover:-translate-y-0.5 focus:outline-none disabled:opacity-70 disabled:cursor-not-allowed">
                        <span x-show="!isSubmitting">Simpan Semua Data Kehadiran</span>
                        <svg x-show="isSubmitting" style="display: none;" class="animate-spin h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                        <span x-show="isSubmitting" style="display: none;">Memproses...</span>
                    </button>
                </div>
            @else
                <!-- Kosong -->
                <div class="flex flex-col items-center justify-center py-20 text-center">
                    <div class="w-20 h-20 bg-blue-50/50 rounded-full flex items-center justify-center mb-5"><svg class="w-10 h-10 text-blue-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg></div>
                    <p class="text-base font-extrabold text-slate-700">Tidak Ada Warga Ditemukan</p>
                    <p class="text-sm text-slate-400 mt-1.5 max-w-sm">Kategori <b>{{ $kategoriAktif }}</b> masih kosong atau belum ada warga aktif di unit Posyandu ini.</p>
                </div>
            @endif
        </div>
    </form>
</div>
@endsection