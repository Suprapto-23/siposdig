<aside
    class="fixed inset-y-0 left-0 z-50 flex flex-col bg-white transition-all duration-300 ease-in-out transform-gpu lg:relative lg:my-4 lg:ml-4 lg:mr-0 lg:rounded-[2rem] border-r lg:border border-slate-200/60 shadow-[0_8px_32px_rgba(0,0,0,0.03)] overflow-hidden shrink-0"
    :class="[
        mobileMenuOpen ? 'translate-x-0 w-[280px]' : '-translate-x-full lg:translate-x-0',
        sidebarCollapsed ? 'lg:w-[88px]' : 'lg:w-[280px]'
    ]">
    
    <!-- Logo -->
    <div class="flex items-center h-[80px] px-5 border-b border-slate-100 shrink-0">
        <div class="flex items-center w-full" :class="sidebarCollapsed ? 'justify-center' : 'justify-start'">
            <div class="flex shrink-0 h-11 w-11 items-center justify-center rounded-2xl bg-gradient-to-tr from-blue-500 to-sky-500 text-white shadow-md font-jakarta font-bold text-xl">
                S
            </div>
            <div class="flex flex-col justify-center transition-all duration-300 ease-in-out whitespace-nowrap overflow-hidden" 
                 :class="sidebarCollapsed ? 'w-0 opacity-0 ml-0' : 'w-[140px] opacity-100 ml-3'">
                <h2 class="font-jakarta text-xl font-extrabold leading-none text-slate-800 tracking-tight">SIPOSDIG</h2>
                <p class="text-[10px] font-bold text-blue-600 uppercase tracking-wider mt-0.5">Ruang Kader</p>
            </div>
        </div>
    </div>

    <!-- Navigasi Utama -->
    <nav class="flex-1 py-4 px-4 space-y-1.5 overflow-y-auto custom-scrollbar overflow-x-hidden">
        
        <!-- Dashboard -->
        <a href="{{ route('kader.dashboard') }}" 
           class="flex items-center rounded-2xl px-3.5 py-3 transition-all duration-200 {{ request()->routeIs('kader.dashboard') ? 'bg-blue-50 text-blue-700 font-bold border border-blue-100/50' : 'text-slate-500 hover:bg-slate-50 hover:text-blue-600 font-medium' }}"
           :class="sidebarCollapsed ? 'justify-center' : 'justify-start'" title="Dashboard">
            <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/></svg>
            <div class="transition-all duration-300 ease-in-out whitespace-nowrap overflow-hidden" 
                 :class="sidebarCollapsed ? 'w-0 opacity-0 ml-0' : 'w-[160px] opacity-100 ml-4'">
                Dashboard
            </div>
        </a>

        <!-- Absensi Kehadiran -->
        <a href="{{ route('kader.absensi.index') }}" 
           class="flex items-center rounded-2xl px-3.5 py-3 transition-all duration-200 {{ request()->routeIs('kader.absensi.*') ? 'bg-blue-50 text-blue-700 font-bold border border-blue-100/50' : 'text-slate-500 hover:bg-slate-50 hover:text-blue-600 font-medium' }}"
           :class="sidebarCollapsed ? 'justify-center' : 'justify-start'" title="Absensi Posyandu">
            <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/></svg>
            <div class="transition-all duration-300 ease-in-out whitespace-nowrap overflow-hidden" 
                 :class="sidebarCollapsed ? 'w-0 opacity-0 ml-0' : 'w-[160px] opacity-100 ml-4'">
                Absensi Kehadiran
            </div>
        </a>

        <!-- Pengukuran Fisik -->
        <a href="{{ route('kader.pengukuran.index') }}" 
           class="flex items-center rounded-2xl px-3.5 py-3 transition-all duration-200 {{ request()->routeIs('kader.pengukuran.*') ? 'bg-blue-50 text-blue-700 font-bold border border-blue-100/50' : 'text-slate-500 hover:bg-slate-50 hover:text-blue-600 font-medium' }}"
           :class="sidebarCollapsed ? 'justify-center' : 'justify-start'" title="Pengukuran Fisik">
            <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3"/></svg>
            <div class="transition-all duration-300 ease-in-out whitespace-nowrap overflow-hidden" 
                 :class="sidebarCollapsed ? 'w-0 opacity-0 ml-0' : 'w-[160px] opacity-100 ml-4'">
                Pengukuran Fisik
            </div>
        </a>

        <!-- Kelola Warga -->
        <a href="{{ route('kader.warga.index') }}" 
           class="flex items-center rounded-2xl px-3.5 py-3 transition-all duration-200 {{ request()->routeIs('kader.warga.*') ? 'bg-blue-50 text-blue-700 font-bold border border-blue-100/50' : 'text-slate-500 hover:bg-slate-50 hover:text-blue-600 font-medium' }}"
           :class="sidebarCollapsed ? 'justify-center' : 'justify-start'" title="Daftar Warga">
            <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
            <div class="transition-all duration-300 ease-in-out whitespace-nowrap overflow-hidden" 
                 :class="sidebarCollapsed ? 'w-0 opacity-0 ml-0' : 'w-[160px] opacity-100 ml-4'">
                Warga Binaan
            </div>
        </a>

        <!-- Laporan & Saran -->
        <div class="mt-3 pt-3 border-t border-slate-100 transition-all duration-300 overflow-hidden" :class="sidebarCollapsed ? 'opacity-0 h-0 my-0 py-0' : 'opacity-100'">
            <p class="px-4 mb-2 text-[10px] font-bold tracking-widest text-slate-400 uppercase">Pelaporan</p>
        </div>

        <a href="{{ route('kader.laporan.index') }}" 
           class="flex items-center rounded-2xl px-3.5 py-3 transition-all duration-200 {{ request()->routeIs('kader.laporan.*') ? 'bg-blue-50 text-blue-700 font-bold border border-blue-100/50' : 'text-slate-500 hover:bg-slate-50 hover:text-blue-600 font-medium' }}"
           :class="sidebarCollapsed ? 'justify-center' : 'justify-start'" title="Laporan Operasional">
            <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
            <div class="transition-all duration-300 ease-in-out whitespace-nowrap overflow-hidden" 
                 :class="sidebarCollapsed ? 'w-0 opacity-0 ml-0' : 'w-[160px] opacity-100 ml-4'">
                Laporan Unit
            </div>
        </a>

        <a href="{{ route('kader.saran.index') }}" 
           class="flex items-center rounded-2xl px-3.5 py-3 transition-all duration-200 {{ request()->routeIs('kader.saran.*') ? 'bg-blue-50 text-blue-700 font-bold border border-blue-100/50' : 'text-slate-500 hover:bg-slate-50 hover:text-blue-600 font-medium' }}"
           :class="sidebarCollapsed ? 'justify-center' : 'justify-start'" title="Kotak Saran">
            <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"/></svg>
            <div class="transition-all duration-300 ease-in-out whitespace-nowrap overflow-hidden" 
                 :class="sidebarCollapsed ? 'w-0 opacity-0 ml-0' : 'w-[160px] opacity-100 ml-4'">
                Saran & Masukan
            </div>
        </a>
    </nav>

    <!-- Logout -->
    <div class="p-4 mt-auto border-t border-slate-100 shrink-0">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="flex w-full items-center rounded-2xl bg-slate-50 border border-slate-100 px-3.5 py-3 text-sm font-bold text-slate-500 hover:bg-red-50 hover:text-red-600 hover:border-red-100 transition-colors duration-200 focus:outline-none"
                    :class="sidebarCollapsed ? 'justify-center' : 'justify-start'" title="Keluar Sesi">
                <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                <div class="transition-all duration-300 ease-in-out whitespace-nowrap overflow-hidden text-left" 
                     :class="sidebarCollapsed ? 'w-0 opacity-0 ml-0' : 'w-[140px] opacity-100 ml-4'">
                    Keluar Sesi
                </div>
            </button>
        </form>
    </div>
</aside>

<!-- Backdrop Mobile -->
<div x-show="mobileMenuOpen" x-transition.opacity x-cloak
     @click="mobileMenuOpen = false"
     class="fixed inset-0 bg-slate-900/40 backdrop-blur-sm z-40 lg:hidden">
</div>