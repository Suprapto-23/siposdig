@extends('layouts.app-warga')
@section('title', 'Profil Akun - SIPOSDIG')

@section('content')
<div class="space-y-6 lg:space-y-8 pb-40 animate-fade-in-up">

    <!-- HEADER PROFIL (KARTU IDENTITAS) -->
    <div class="bg-gradient-to-br from-blue-600 via-blue-500 to-sky-400 rounded-[2.5rem] p-8 shadow-[0_15px_40px_rgba(59,130,246,0.25)] relative overflow-hidden flex flex-col md:flex-row items-center gap-6 text-center md:text-left">
        <div class="absolute top-0 right-0 -mt-10 -mr-10 w-40 h-40 bg-white/10 rounded-full blur-2xl pointer-events-none"></div>
        <div class="absolute bottom-0 left-0 -mb-10 -ml-10 w-40 h-40 bg-white/10 rounded-full blur-3xl pointer-events-none"></div>
        
        <div class="w-24 h-24 sm:w-28 sm:h-28 rounded-[2rem] bg-white text-blue-600 flex items-center justify-center font-black text-4xl shadow-xl relative z-10 shrink-0 mx-auto md:mx-0 ring-4 ring-white/30">
            {{ substr($warga->nama_lengkap, 0, 1) }}
        </div>
        
        <div class="relative z-10 w-full">
            <h2 class="text-2xl sm:text-3xl font-black text-white leading-tight">{{ $warga->nama_lengkap }}</h2>
            <p class="text-blue-100 text-sm font-bold tracking-widest mt-1">{{ $warga->nik }}</p>
            
            <div class="flex flex-wrap items-center justify-center md:justify-start gap-2 mt-4">
                <span class="bg-black/10 backdrop-blur-sm border border-white/20 text-white text-[10px] font-extrabold uppercase tracking-wider px-3 py-1.5 rounded-xl">Kategori: {{ $warga->kategori }}</span>
                <span class="bg-white/20 backdrop-blur-sm border border-white/30 text-white text-[10px] font-extrabold uppercase tracking-wider px-3 py-1.5 rounded-xl flex items-center gap-1">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                    {{ $warga->unitPosyandu->nama ?? 'Mandiri' }}
                </span>
            </div>
        </div>
    </div>

    <!-- PERINGATAN GANTI PASSWORD (Muncul Jika Warga Masih Pakai Password Acak Sistem) -->
    @if($warga->wajib_ganti_password)
    <div class="bg-amber-50 border border-amber-200 p-5 rounded-[2rem] flex gap-4 shadow-sm relative overflow-hidden">
        <div class="w-1.5 h-full bg-amber-400 absolute left-0 top-0"></div>
        <div class="w-10 h-10 bg-amber-100 text-amber-600 rounded-xl flex items-center justify-center shrink-0">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
        </div>
        <div>
            <h4 class="text-sm font-black text-amber-800">Keamanan Akun Menurun</h4>
            <p class="text-xs font-medium text-amber-700 mt-1">Anda masih menggunakan kata sandi bawaan dari sistem. Segera perbarui kata sandi Anda di menu bawah untuk mengamankan akun.</p>
        </div>
    </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 lg:gap-8">
        
        <!-- KARTU 1: INFO PRIBADI & KONTAK -->
        <div class="bg-white/90 backdrop-blur-2xl border border-slate-100 p-6 lg:p-8 rounded-[2rem] shadow-[0_8px_30px_rgba(37,99,235,0.04)] h-fit">
            <div class="flex items-center gap-3 mb-6">
                <div class="w-10 h-10 bg-blue-50 text-blue-600 rounded-xl flex items-center justify-center">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2"/></svg>
                </div>
                <h3 class="text-base font-black text-slate-800">Data Diri & Kontak</h3>
            </div>

            <!-- Data Terkunci -->
            <div class="grid grid-cols-2 gap-4 mb-6 p-4 bg-slate-50 border border-slate-100 rounded-2xl">
                <div>
                    <span class="block text-[10px] font-extrabold text-slate-400 uppercase tracking-widest mb-1">Tanggal Lahir</span>
                    <span class="text-sm font-bold text-slate-700">{{ \Carbon\Carbon::parse($warga->tanggal_lahir)->translatedFormat('d F Y') }}</span>
                </div>
                <div>
                    <span class="block text-[10px] font-extrabold text-slate-400 uppercase tracking-widest mb-1">Jenis Kelamin</span>
                    <span class="text-sm font-bold text-slate-700">{{ $warga->jenis_kelamin == 'L' ? 'Laki-Laki' : 'Perempuan' }}</span>
                </div>
            </div>

            <form action="{{ route('warga.profil.update') }}" method="POST" class="space-y-4">
                @csrf @method('PUT')
                
                <div>
                    <label class="block text-[11px] font-extrabold text-slate-400 uppercase tracking-widest mb-2">Nomor HP/WhatsApp</label>
                    <input type="text" name="no_hp" value="{{ old('no_hp', $warga->no_hp) }}" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl text-sm font-bold text-slate-700 outline-none focus:bg-white focus:border-blue-500 transition-colors" placeholder="08xxxxxxxxxx">
                    @error('no_hp') <p class="text-[10px] text-rose-500 font-bold mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-[11px] font-extrabold text-slate-400 uppercase tracking-widest mb-2">Alamat Lengkap</label>
                    <textarea name="alamat" rows="3" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl text-sm font-bold text-slate-700 outline-none focus:bg-white focus:border-blue-500 transition-colors placeholder:font-medium resize-none">{{ old('alamat', $warga->alamat) }}</textarea>
                    @error('alamat') <p class="text-[10px] text-rose-500 font-bold mt-1">{{ $message }}</p> @enderror
                </div>

                <button type="submit" class="w-full py-3.5 bg-slate-800 hover:bg-slate-900 text-white font-extrabold text-sm rounded-2xl transition-all shadow-[0_8px_20px_rgba(0,0,0,0.1)] hover:-translate-y-0.5">
                    Simpan Perubahan Data
                </button>
            </form>
        </div>

        <!-- KARTU 2: GANTI PASSWORD -->
        <div class="bg-white/90 backdrop-blur-2xl border border-slate-100 p-6 lg:p-8 rounded-[2rem] shadow-[0_8px_30px_rgba(37,99,235,0.04)] h-fit">
            <div class="flex items-center gap-3 mb-6">
                <div class="w-10 h-10 bg-rose-50 text-rose-500 rounded-xl flex items-center justify-center">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                </div>
                <h3 class="text-base font-black text-slate-800">Keamanan & Sandi</h3>
            </div>

            <form action="{{ route('warga.profil.password') }}" method="POST" class="space-y-4">
                @csrf @method('PUT')
                
                <div>
                    <label class="block text-[11px] font-extrabold text-slate-400 uppercase tracking-widest mb-2">Kata Sandi Saat Ini</label>
                    <input type="password" name="current_password" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl text-sm font-bold text-slate-700 outline-none focus:bg-white focus:border-rose-400 transition-colors placeholder:font-medium placeholder:text-slate-300" placeholder="••••••••">
                    @error('current_password') <p class="text-[10px] text-rose-500 font-bold mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-[11px] font-extrabold text-slate-400 uppercase tracking-widest mb-2">Kata Sandi Baru</label>
                    <input type="password" name="password" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl text-sm font-bold text-slate-700 outline-none focus:bg-white focus:border-rose-400 transition-colors placeholder:font-medium placeholder:text-slate-300" placeholder="••••••••">
                    @error('password') <p class="text-[10px] text-rose-500 font-bold mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-[11px] font-extrabold text-slate-400 uppercase tracking-widest mb-2">Ulangi Kata Sandi Baru</label>
                    <input type="password" name="password_confirmation" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl text-sm font-bold text-slate-700 outline-none focus:bg-white focus:border-rose-400 transition-colors placeholder:font-medium placeholder:text-slate-300" placeholder="••••••••">
                </div>

                <div class="pt-2">
                    <button type="submit" class="w-full py-3.5 bg-gradient-to-r from-blue-500 to-sky-400 hover:from-blue-600 hover:to-sky-500 text-white font-extrabold text-sm rounded-2xl transition-all shadow-[0_8px_20px_rgba(59,130,246,0.3)] hover:-translate-y-0.5">
                        Perbarui Kata Sandi
                    </button>
                </div>
            </form>
        </div>

    </div>
</div>
@endsection