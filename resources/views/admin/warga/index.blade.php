@extends('layouts.app-admin')
@section('title', 'Kelola Warga Binaan - SIPOSDIG')

@section('content')
<div class="space-y-6 pb-12 animate-fade-in-up">

    <!-- Header & Tombol Tambah -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 bg-white/80 backdrop-blur-2xl border border-white p-6 rounded-[2rem] shadow-[0_8px_30px_rgba(37,99,235,0.04)]">
        <div>
            <h2 class="font-jakarta text-2xl font-black text-slate-800 tracking-tight">Kelola Data Warga</h2>
            <p class="text-[13px] text-slate-500 font-medium mt-1">Manajemen data kependudukan, balita, remaja, hingga lansia binaan posyandu.</p>
        </div>
        <div class="flex items-center gap-3 w-full sm:w-auto">
            <form method="GET" action="{{ route('admin.warga.index') }}" class="relative flex-1 sm:w-64">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari NIK atau Nama..." class="w-full pl-4 pr-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl text-sm font-medium outline-none focus:bg-white focus:border-blue-400">
            </form>
            <a href="{{ route('admin.warga.create') }}" class="px-5 py-3 bg-blue-500 hover:bg-blue-600 text-white font-extrabold text-sm rounded-2xl shadow-sm transition-all whitespace-nowrap">
                + Tambah Warga
            </a>
        </div>
    </div>

    <!-- Alert Notifikasi Biasa (jika update/delete sukses) -->
    @if(session('success'))
        <div class="p-4 bg-emerald-50 border border-emerald-200 text-emerald-800 font-bold rounded-2xl shadow-sm flex items-center gap-3">
            <svg class="w-5 h-5 text-emerald-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    <!-- Tabel Warga -->
    <div class="bg-white/90 backdrop-blur-2xl border border-slate-100 rounded-[2rem] shadow-[0_8px_30px_rgba(37,99,235,0.04)] overflow-hidden">
        <div class="overflow-x-auto custom-scrollbar">
            <table class="w-full text-left border-collapse min-w-[900px]">
                <thead>
                    <tr class="bg-slate-50/50 border-b border-slate-100 text-[11px] uppercase tracking-widest font-extrabold text-slate-400">
                        <th class="px-6 py-4">Nama Lengkap & NIK (Login)</th>
                        <th class="px-6 py-4 text-center">Kategori</th>
                        <th class="px-6 py-4">Unit Posyandu & Alamat</th>
                        <th class="px-6 py-4 text-center">Status Akun</th>
                        <th class="px-6 py-4 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100/80">
                    @forelse($warga as $item)
                    <tr class="hover:bg-blue-50/30 transition-colors">
                        <td class="px-6 py-4">
                            <p class="text-sm font-bold text-slate-800">{{ $item->nama_lengkap }}</p>
                            <p class="text-[11px] font-bold text-slate-400 font-mono mt-0.5">NIK: {{ $item->nik }}</p>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <span class="px-3 py-1 bg-blue-50 text-blue-600 border border-blue-100 rounded-lg text-xs font-bold uppercase">{{ $item->kategori }}</span>
                        </td>
                        <td class="px-6 py-4">
                            <p class="text-sm font-bold text-slate-700">{{ $item->unitPosyandu->nama ?? 'Mandiri' }}</p>
                            <p class="text-xs text-slate-400 font-medium truncate max-w-xs mt-0.5">{{ $item->alamat }}</p>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <span class="px-3 py-1 rounded-full text-xs font-extrabold {{ $item->status == 'aktif' ? 'bg-emerald-50 text-emerald-600 border border-emerald-200' : 'bg-slate-100 text-slate-500' }}">
                                {{ ucfirst($item->status ?? 'Aktif') }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <div class="flex items-center justify-end gap-2">
                                <!-- Tombol Reset Password Acak -->
                                <form action="{{ route('admin.warga.reset-password', $item->id) }}" method="POST" onsubmit="return confirm('Generate kata sandi unik acak baru untuk warga ini?');">
                                    @csrf
                                    <button type="submit" title="Reset Password Acak" class="p-2 bg-amber-50 hover:bg-amber-100 text-amber-600 rounded-xl transition-all cursor-pointer shadow-sm">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"/></svg>
                                    </button>
                                </form>

                                <a href="{{ route('admin.warga.edit', $item->id) }}" class="px-3 py-1.5 bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold text-xs rounded-xl transition-all">Edit</a>
                                
                                <form action="{{ route('admin.warga.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Hapus data warga ini beserta riwayatnya?');">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="px-3 py-1.5 bg-rose-50 hover:bg-rose-100 text-rose-600 font-bold text-xs rounded-xl transition-all">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-16 text-center text-slate-400 font-bold text-sm">Belum ada data warga terdaftar.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($warga->hasPages())
        <div class="px-6 py-4 border-t border-slate-100">{{ $warga->links() }}</div>
        @endif
    </div>
</div>

    <!-- MODAL POP-UP KREDENSIAL PREMIUM (MUNCUL SAAT SIMPAN / RESET PASSWORD) -->
    @if(session('modal_pass'))
    <div class="fixed inset-0 z-50 flex items-center justify-center bg-slate-900/40 backdrop-blur-md animate-fade-in">
        <div class="bg-white/95 backdrop-blur-2xl border border-white p-8 rounded-[2.5rem] shadow-[0_20px_50px_rgba(0,0,0,0.15)] max-w-md w-full mx-4 text-center space-y-6">
            
            <!-- Icon Sukses -->
            <div class="w-16 h-16 bg-emerald-50 text-emerald-500 rounded-3xl mx-auto flex items-center justify-center border border-emerald-100 shadow-inner">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
            </div>

            <div>
                <h3 class="text-xl font-black text-slate-800 tracking-tight">{{ session('modal_title') }}</h3>
                <p class="text-xs font-medium text-slate-500 mt-1">{{ session('modal_sub') }}</p>
            </div>

            <!-- Kotak Kredensial -->
            <div class="bg-slate-50 border border-slate-200/80 p-4 rounded-2xl text-left space-y-3">
                <div>
                    <label class="text-[10px] font-extrabold text-slate-400 uppercase tracking-widest block mb-1">NIK (Akses Masuk Login)</label>
                    <div class="flex items-center justify-between bg-white border border-slate-200 px-3.5 py-2.5 rounded-xl font-mono text-sm font-bold text-slate-700">
                        <span>{{ session('modal_user') }}</span>
                    </div>
                </div>

                <div>
                    <label class="text-[10px] font-extrabold text-slate-400 uppercase tracking-widest block mb-1">Password Acak Sistem</label>
                    <div class="flex items-center justify-between bg-white border border-slate-200 px-3.5 py-2.5 rounded-xl font-mono text-sm font-extrabold text-blue-600">
                        <span>{{ session('modal_pass') }}</span>
                        <button onclick="navigator.clipboard.writeText('{{ session('modal_pass') }}'); alert('Password berhasil disalin ke clipboard!');" class="text-slate-400 hover:text-blue-600 transition-colors p-1" title="Salin Password">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-1M8 5a2 2 0 002 2h2a2 2 0 002-2M8 5a2 2 0 012-2h2a2 2 0 012 2m0 0h2a2 2 0 012 2v3m2 4H10m0 0l3-3m-3 3l3 3"/></svg>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Tombol Konfirmasi -->
            <button type="button" onclick="window.location.href='{{ route('admin.warga.index') }}'" class="w-full py-3.5 bg-gradient-to-r from-blue-500 to-sky-500 hover:from-blue-600 hover:to-sky-600 text-white font-extrabold text-sm rounded-2xl shadow-[0_8px_20px_-6px_rgba(14,165,233,0.4)] transition-all cursor-pointer">
                Saya Sudah Menyalinnya
            </button>

        </div>
    </div>
    @endif
@endsection