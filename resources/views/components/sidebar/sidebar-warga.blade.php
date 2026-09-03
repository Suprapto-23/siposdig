<aside :class="sidebarOpen ? 'translate-x-0 opacity-100' : '-translate-x-[120%] opacity-0 pointer-events-none'" 
       class="fixed top-4 bottom-4 left-4 lg:top-6 lg:bottom-6 lg:left-6 z-50 w-[260px] lg:w-72 bg-white/90 backdrop-blur-2xl border border-white flex flex-col justify-between p-5 lg:p-6 rounded-[2rem] shadow-[0_20px_50px_rgba(37,99,235,0.1)] overflow-y-auto custom-scrollbar transition-all duration-500 ease-in-out">
    
    <div class="space-y-6 lg:space-y-8">
        <!-- Logo & Tombol Tutup Mobile -->
        <div class="flex items-center justify-between px-2 mt-1">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 lg:w-12 lg:h-12 rounded-2xl bg-gradient-to-tr from-blue-600 to-sky-400 flex items-center justify-center text-white font-black text-lg lg:text-xl shadow-[0_8px_20px_rgba(37,99,235,0.3)] shrink-0">
                    S
                </div>
                <div>
                    <h1 class="font-jakarta text-base lg:text-lg font-black tracking-tight text-slate-800 leading-none mb-1">SIPOSDIG</h1>
                    <span class="text-[9px] lg:text-[10px] font-extrabold uppercase tracking-widest text-blue-600 leading-none">Portal Warga</span>
                </div>
            </div>
            <!-- Tombol X HANYA muncul di Mobile -->
            <button @click="sidebarOpen = false" class="lg:hidden p-2 text-slate-400 hover:text-rose-500 bg-slate-50 rounded-xl">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>

        <!-- Menu Navigasi -->
        <nav class="space-y-1.5">
            <p class="px-3 text-[10px] font-extrabold text-slate-400 uppercase tracking-widest mb-3">Menu Layanan</p>
            
            <a href="{{ route('warga.dashboard') }}" class="flex items-center gap-3 px-4 py-3 rounded-2xl text-sm font-bold transition-all {{ request()->routeIs('warga.dashboard') ? 'bg-blue-500 text-white shadow-[0_8px_20px_rgba(59,130,246,0.3)]' : 'text-slate-600 hover:bg-slate-50 hover:text-blue-600' }}">
                <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                Beranda
            </a>

            <a href="{{ route('warga.riwayat.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-2xl text-sm font-bold transition-all {{ request()->routeIs('warga.riwayat.*') ? 'bg-blue-500 text-white shadow-[0_8px_20px_rgba(59,130,246,0.3)]' : 'text-slate-600 hover:bg-slate-50 hover:text-blue-600' }}">
                <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                Riwayat Kesehatan
            </a>

            <a href="{{ route('warga.edukasi.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-2xl text-sm font-bold transition-all {{ request()->routeIs('warga.edukasi.*') ? 'bg-blue-500 text-white shadow-[0_8px_20px_rgba(59,130,246,0.3)]' : 'text-slate-600 hover:bg-slate-50 hover:text-blue-600' }}">
                <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                Edukasi
            </a>

            <a href="{{ route('warga.profil.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-2xl text-sm font-bold transition-all {{ request()->routeIs('warga.profil.*') ? 'bg-blue-500 text-white shadow-[0_8px_20px_rgba(59,130,246,0.3)]' : 'text-slate-600 hover:bg-slate-50 hover:text-blue-600' }}">
                <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                Profil Akun
            </a>
        </nav>
    </div>

    <!-- Tombol Keluar -->
    <div class="pt-4 mt-4 border-t border-slate-100">
        <form action="{{ route('logout') }}" method="POST" onsubmit="return confirm('Yakin ingin keluar dari sistem?');">
            @csrf
            <button type="submit" class="w-full flex items-center gap-3 px-4 py-3 rounded-2xl text-sm font-bold text-rose-600 bg-rose-50/50 hover:bg-rose-100/80 transition-all cursor-pointer">
                <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                Keluar Sesi
            </button>
        </form>
    </div>
</aside>