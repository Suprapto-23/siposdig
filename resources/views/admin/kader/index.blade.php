@extends('layouts.app-admin')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 space-y-6">

    <!-- Modal Kredensial Glassmorphism (Muncul 1 kali saja) -->
    @if(session('kredensial_baru'))
    <div x-data="{ show: true, copied: false }" x-show="show" class="fixed inset-0 z-50 flex items-center justify-center">
        <!-- Backdrop Blur -->
        <div class="absolute inset-0 bg-slate-900/30 backdrop-blur-sm transition-opacity" @click="show = false"></div>
        
        <!-- Modal Card -->
        <div class="relative w-full max-w-md bg-white/70 backdrop-blur-2xl border border-white/60 shadow-[0_8px_32px_rgba(37,99,235,0.15)] rounded-2xl p-8 transform transition-all">
            <div class="w-12 h-12 bg-emerald-100 rounded-full flex items-center justify-center mb-4 border border-emerald-200">
                <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            </div>
            <h3 class="text-xl font-bold font-jakarta text-slate-900 mb-2">Akun Kader Dibuat</h3>
            <p class="text-sm font-inter text-slate-500 mb-6">Salin kredensial berikut dan berikan kepada petugas kader. <span class="font-semibold text-red-500">Sistem hanya menampilkannya satu kali ini saja.</span></p>
            
            <div class="bg-slate-50 border border-slate-200 rounded-xl p-4 mb-6 relative group">
                <div class="mb-2">
                    <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Email</p>
                    <p class="text-sm text-slate-900 font-medium">{{ session('kredensial_baru')['email'] }}</p>
                </div>
                <div>
                    <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Password Sementara</p>
                    <p class="text-lg text-slate-900 font-mono tracking-widest font-bold">{{ session('kredensial_baru')['password'] }}</p>
                </div>
                
                <button @click="navigator.clipboard.writeText('Email: {{ session('kredensial_baru')['email'] }}\nPassword: {{ session('kredensial_baru')['password'] }}'); copied = true; setTimeout(() => copied = false, 2000)" 
                        class="absolute top-4 right-4 p-2 bg-white border border-slate-200 rounded-lg shadow-sm hover:border-blue-600 hover:text-blue-600 transition-all focus:outline-none">
                    <span x-show="!copied"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"></path></svg></span>
                    <span x-show="copied" class="text-emerald-600 text-xs font-semibold">Disalin!</span>
                </button>
            </div>
            
            <button @click="show = false" class="w-full py-3 bg-blue-600 text-white font-semibold rounded-xl shadow-sm hover:bg-blue-700 transition-all focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                Saya Sudah Menyalinnya
            </button>
        </div>
    </div>
    @endif

    <!-- Header Halaman -->
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h1 class="text-2xl font-bold font-jakarta text-slate-900 tracking-tight">Kelola Data Kader</h1>
            <p class="text-sm font-inter text-slate-500 mt-1">Manajemen akun petugas kader, penempatan unit posyandu, dan status aktif.</p>
        </div>
        <div class="flex flex-col sm:flex-row items-center gap-3 w-full sm:w-auto">
            <form action="{{ route('admin.kader.index') }}" method="GET" class="relative w-full sm:w-64">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-4 w-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                </div>
                <input type="text" name="search" value="{{ request('search') }}" class="block w-full pl-10 pr-3 py-2 border border-slate-200 rounded-xl leading-5 bg-slate-50 placeholder-slate-400 focus:outline-none focus:bg-white focus:border-blue-500 focus:ring-1 focus:ring-blue-500 sm:text-sm transition-colors" placeholder="Cari Nama atau Email...">
            </form>
            <a href="{{ route('admin.kader.create') }}" class="inline-flex items-center justify-center w-full sm:w-auto rounded-xl bg-blue-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-all whitespace-nowrap">
                <svg class="-ml-1 mr-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                Tambah Kader Baru
            </a>
        </div>
    </div>

    <!-- Tabel Data Kader -->
    <div class="bg-white border border-slate-200 rounded-2xl shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b border-slate-200 bg-slate-50/50">
                        <th class="px-6 py-4 text-xs font-semibold text-slate-500 uppercase tracking-wider font-inter">Profil Kader</th>
                        <th class="px-6 py-4 text-xs font-semibold text-slate-500 uppercase tracking-wider font-inter">Penempatan Unit</th>
                        <th class="px-6 py-4 text-xs font-semibold text-slate-500 uppercase tracking-wider font-inter">Tanggal Bergabung</th>
                        <th class="px-6 py-4 text-xs font-semibold text-slate-500 uppercase tracking-wider font-inter">Status</th>
                        <th class="px-6 py-4 text-xs font-semibold text-slate-500 uppercase tracking-wider font-inter text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($kaders as $k)
                    <tr class="hover:bg-slate-50/80 transition-colors">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-full bg-blue-50 text-blue-600 flex items-center justify-center font-bold text-sm shrink-0 border border-blue-100">
                                    {{ strtoupper(substr($k->nama, 0, 1)) }}
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-slate-900 font-jakarta">{{ $k->nama }}</p>
                                    <p class="text-xs text-slate-500 font-inter">{{ $k->email }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <p class="text-sm text-slate-900 font-medium">{{ $k->unit->nama ?? '-' }}</p>
                            <p class="text-xs text-slate-500">{{ $k->unit->alamat ?? '-' }}</p>
                        </td>
                        <td class="px-6 py-4 text-sm text-slate-500 tabular-nums">
                            {{ $k->created_at->format('d M Y') }}
                        </td>
                        <td class="px-6 py-4">
                            @if($k->status === 'aktif')
                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-emerald-50 text-emerald-700 border border-emerald-200">
                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 mr-1.5"></span> Aktif
                                </span>
                            @else
                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-slate-100 text-slate-700 border border-slate-200">
                                    <span class="w-1.5 h-1.5 rounded-full bg-slate-400 mr-1.5"></span> Nonaktif
                                </span>
                            @endif
                            
                            <!-- Indikator Wajib Ganti Password (Peringatan belum pernah login) -->
                            @if($k->wajib_ganti_password)
                                <p class="text-[10px] text-amber-600 mt-1.5 font-semibold flex items-center gap-1">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                                    Belum Aktivasi
                                </p>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-right">
                            <div class="flex items-center justify-end gap-2">
                                <!-- Tombol Reset Password -->
                                <form action="{{ route('admin.kader.reset-password', $k->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Reset password untuk kader ini? Sistem akan membuatkan password acak baru.');">
                                    @csrf
                                    <button type="submit" class="p-2 text-slate-400 hover:text-amber-500 hover:bg-amber-50 rounded-lg transition-colors border border-transparent hover:border-amber-100" title="Reset Password">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"></path></svg>
                                    </button>
                                </form>

                                <!-- Tombol Edit -->
                                <a href="{{ route('admin.kader.edit', $k->id) }}" class="p-2 text-slate-400 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition-colors border border-transparent hover:border-blue-100" title="Edit Data">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                                </a>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-12 text-center">
                            <svg class="w-12 h-12 text-slate-300 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                            <p class="text-slate-500 text-sm font-medium font-inter">Belum ada data kader di sistem.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <!-- Pagination -->
        @if($kaders->hasPages())
        <div class="px-6 py-4 border-t border-slate-100 bg-slate-50/30">
            {{ $kaders->withQueryString()->links() }}
        </div>
        @endif
    </div>
</div>
@endsection