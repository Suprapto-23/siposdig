<header class="sticky top-0 z-40 bg-white/90 backdrop-blur-xl border-b border-slate-100 px-6 py-4 flex items-center justify-between">
    <div class="flex items-center gap-3">
        <div class="w-10 h-10 rounded-2xl bg-gradient-to-tr from-blue-600 to-sky-400 flex items-center justify-center text-white font-black shadow-[0_4px_12px_rgba(37,99,235,0.3)]">
            S
        </div>
        <div>
            <span class="text-[10px] font-black tracking-widest uppercase text-blue-600 block leading-none mb-1">SIPOSDIG</span>
            <h1 class="text-sm font-extrabold text-slate-800 leading-none">Portal Warga</h1>
        </div>
    </div>

    <!-- Tombol Keluar Sesi -->
    <form action="{{ route('logout') }}" method="POST" class="m-0" onsubmit="return confirm('Apakah Anda yakin ingin keluar dari sistem?');">
        @csrf
        <button type="submit" class="w-10 h-10 rounded-2xl bg-slate-50 hover:bg-rose-50 text-slate-400 hover:text-rose-600 border border-slate-200/80 flex items-center justify-center transition-all cursor-pointer shadow-sm">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
        </button>
    </form>
</header>