<nav class="fixed bottom-0 left-1/2 -translate-x-1/2 w-full max-w-md z-50 p-4 pointer-events-none">
    <div class="bg-white/95 backdrop-blur-2xl border border-slate-100 shadow-[0_10px_40px_rgba(0,0,0,0.08)] rounded-3xl px-2 py-2 flex items-center justify-around pointer-events-auto">
        
        <a href="{{ route('warga.dashboard') }}" class="flex flex-col items-center gap-1 transition-all {{ request()->routeIs('warga.dashboard') ? 'text-blue-600' : 'text-slate-400 hover:text-slate-600' }}">
            <div class="{{ request()->routeIs('warga.dashboard') ? 'bg-blue-50 p-2.5 rounded-2xl' : 'p-2.5' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
            </div>
            <span class="text-[9px] font-extrabold tracking-tight">Beranda</span>
        </a>

        <a href="{{ route('warga.riwayat.index') }}" class="flex flex-col items-center gap-1 transition-all {{ request()->routeIs('warga.riwayat.*') ? 'text-blue-600' : 'text-slate-400 hover:text-slate-600' }}">
            <div class="{{ request()->routeIs('warga.riwayat.*') ? 'bg-blue-50 p-2.5 rounded-2xl' : 'p-2.5' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
            </div>
            <span class="text-[9px] font-extrabold tracking-tight">Riwayat</span>
        </a>

        <a href="{{ route('warga.edukasi.index') }}" class="flex flex-col items-center gap-1 transition-all {{ request()->routeIs('warga.edukasi.*') ? 'text-blue-600' : 'text-slate-400 hover:text-slate-600' }}">
            <div class="{{ request()->routeIs('warga.edukasi.*') ? 'bg-blue-50 p-2.5 rounded-2xl' : 'p-2.5' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
            </div>
            <span class="text-[9px] font-extrabold tracking-tight">Edukasi</span>
        </a>

        <a href="{{ route('warga.profil.index') }}" class="flex flex-col items-center gap-1 transition-all {{ request()->routeIs('warga.profil.*') ? 'text-blue-600' : 'text-slate-400 hover:text-slate-600' }}">
            <div class="{{ request()->routeIs('warga.profil.*') ? 'bg-blue-50 p-2.5 rounded-2xl' : 'p-2.5' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
            </div>
            <span class="text-[9px] font-extrabold tracking-tight">Profil</span>
        </a>
        
    </div>
</nav>