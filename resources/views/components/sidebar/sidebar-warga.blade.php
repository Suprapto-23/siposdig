<aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'" 
       class="fixed inset-y-0 left-0 z-50 w-[260px] transform bg-white md:m-4 md:mr-0 md:rounded-[24px] shadow-[0_8px_32px_rgba(37,99,235,0.04)] flex flex-col transition-transform duration-300 md:relative md:translate-x-0 border border-slate-100">
    
    <!-- Logo & Branding -->
    <div class="flex items-center gap-3 px-6 py-8">
        <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-blue-600 text-white shadow-md shadow-blue-500/20">
            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/></svg>
        </div>
        <div>
            <h2 class="font-display text-lg font-bold leading-none text-slate-900 tracking-tight">SIPOSDIG</h2>
            <p class="text-[10px] font-semibold text-blue-600 uppercase tracking-wider mt-0.5">Platform Posyandu</p>
        </div>
    </div>

    <!-- Menu Navigasi -->
    <nav class="flex-1 px-4 space-y-1.5 overflow-y-auto custom-scrollbar">
        <!-- Menu Aktif (Dashboard) -->
        <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 rounded-xl bg-blue-600 px-4 py-3.5 text-white shadow-md shadow-blue-500/20 transition-all">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/></svg>
            <span class="text-sm font-bold tracking-wide">Dashboard</span>
        </a>

        <!-- Menu Inaktif -->
        <a href="#" class="flex items-center gap-3 rounded-xl px-4 py-3.5 text-slate-500 hover:bg-slate-50 hover:text-blue-600 transition-colors group">
            <svg class="w-5 h-5 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            <span class="text-sm font-semibold">Verifikasi Akun</span>
        </a>
        
        <a href="#" class="flex items-center gap-3 rounded-xl px-4 py-3.5 text-slate-500 hover:bg-slate-50 hover:text-blue-600 transition-colors group">
            <svg class="w-5 h-5 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
            <span class="text-sm font-semibold">Kelola Kader</span>
        </a>

        <!-- Tambahkan menu lainnya menyesuaikan pola di atas -->
    </nav>

    <!-- Tombol Logout -->
    <div class="p-5 mt-auto">
        <form method="POST" action="#">
            @csrf
            <button type="submit" class="flex w-full items-center justify-center gap-2 rounded-xl border-2 border-slate-100 bg-white px-4 py-3 text-sm font-bold text-slate-600 hover:border-red-100 hover:bg-red-50 hover:text-red-600 transition-all">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                Keluar Akun
            </button>
        </form>
    </div>
</aside>