<aside
    class="fixed inset-y-0 left-0 z-50 flex flex-col bg-white transition-all duration-300 ease-in-out transform-gpu lg:relative lg:my-4 lg:ml-4 lg:mr-0 lg:rounded-[2rem] border-r lg:border border-slate-200/60 shadow-sm overflow-hidden shrink-0"
    :class="[
        mobileMenuOpen ? 'translate-x-0 w-[280px]' : '-translate-x-full lg:translate-x-0',
        sidebarCollapsed ? 'lg:w-[88px]' : 'lg:w-[280px]'
    ]">
    
    <!-- Logo & Branding -->
    <div class="flex items-center h-[80px] px-5 border-b border-slate-100 shrink-0">
        <div class="flex items-center w-full" :class="sidebarCollapsed ? 'justify-center' : 'justify-start'">
            <div class="flex shrink-0 h-11 w-11 items-center justify-center rounded-2xl bg-blue-600 text-white shadow-md font-display font-bold text-xl">
                S
            </div>
            <!-- Teks Logo tanpa 'hidden', murni width & opacity -->
            <div class="flex flex-col justify-center transition-all duration-300 ease-in-out whitespace-nowrap overflow-hidden" 
                 :class="sidebarCollapsed ? 'w-0 opacity-0 ml-0' : 'w-[140px] opacity-100 ml-3'">
                <h2 class="font-display text-xl font-bold leading-none text-slate-900 tracking-tight">SIPOSDIG</h2>
                <p class="text-[10px] font-bold text-blue-600 uppercase tracking-wider mt-0.5">Administrator</p>
            </div>
        </div>
    </div>

    <!-- Menu Navigasi -->
    <nav class="flex-1 py-4 px-4 space-y-1.5 overflow-y-auto custom-scrollbar overflow-x-hidden">
        
        <!-- Dashboard -->
        <a href="{{ route('admin.dashboard') }}" 
           class="flex items-center rounded-2xl px-3.5 py-3 transition-all duration-200 {{ request()->routeIs('admin.dashboard') ? 'bg-blue-50 text-blue-700 font-bold border border-blue-100/50' : 'text-slate-500 hover:bg-slate-50 hover:text-blue-600 font-medium' }}"
           :class="sidebarCollapsed ? 'justify-center' : 'justify-start'" title="Dashboard">
            <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/></svg>
            <div class="transition-all duration-300 ease-in-out whitespace-nowrap overflow-hidden" 
                 :class="sidebarCollapsed ? 'w-0 opacity-0 ml-0' : 'w-[160px] opacity-100 ml-4'">
                Dashboard
            </div>
        </a>

        <!-- Verifikasi Akun -->
        <a href="{{ route('admin.verifikasi.index') }}" 
           class="flex items-center rounded-2xl px-3.5 py-3 transition-all duration-200 {{ request()->routeIs('admin.verifikasi.*') ? 'bg-blue-50 text-blue-700 font-bold border border-blue-100/50' : 'text-slate-500 hover:bg-slate-50 hover:text-blue-600 font-medium' }}"
           :class="sidebarCollapsed ? 'justify-center' : 'justify-start'" title="Verifikasi Akun">
            <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            <div class="transition-all duration-300 ease-in-out whitespace-nowrap overflow-hidden flex items-center justify-between" 
                 :class="sidebarCollapsed ? 'w-0 opacity-0 ml-0' : 'w-[160px] opacity-100 ml-4'">
                <span>Verifikasi Akun</span>
                @php $pendingCount = \App\Models\Warga::where('status', 'pending')->count(); @endphp
                @if($pendingCount > 0)
                    <span class="inline-flex items-center justify-center w-5 h-5 text-[10px] font-bold text-white bg-blue-600 rounded-full shrink-0 shadow-sm">{{ $pendingCount }}</span>
                @endif
            </div>
        </a>

        <!-- Kelola Kader -->
        <a href="{{ route('admin.kader.index') }}" 
           class="flex items-center rounded-2xl px-3.5 py-3 transition-all duration-200 {{ request()->routeIs('admin.kader.*') ? 'bg-blue-50 text-blue-700 font-bold border border-blue-100/50' : 'text-slate-500 hover:bg-slate-50 hover:text-blue-600 font-medium' }}"
           :class="sidebarCollapsed ? 'justify-center' : 'justify-start'" title="Kelola Kader">
            <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
            <div class="transition-all duration-300 ease-in-out whitespace-nowrap overflow-hidden" 
                 :class="sidebarCollapsed ? 'w-0 opacity-0 ml-0' : 'w-[160px] opacity-100 ml-4'">
                Kelola Kader
            </div>
        </a>

        <!-- Kelola Warga -->
        <a href="{{ route('admin.warga.index') }}" 
           class="flex items-center rounded-2xl px-3.5 py-3 transition-all duration-200 {{ request()->routeIs('admin.warga.*') ? 'bg-blue-50 text-blue-700 font-bold border border-blue-100/50' : 'text-slate-500 hover:bg-slate-50 hover:text-blue-600 font-medium' }}"
           :class="sidebarCollapsed ? 'justify-center' : 'justify-start'" title="Kelola Warga">
            <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
            <div class="transition-all duration-300 ease-in-out whitespace-nowrap overflow-hidden" 
                 :class="sidebarCollapsed ? 'w-0 opacity-0 ml-0' : 'w-[160px] opacity-100 ml-4'">
                Kelola Warga
            </div>
        </a>

        <!-- Unit Posyandu -->
        <a href="{{ route('admin.unit-posyandu.index') }}" 
   class="flex items-center rounded-2xl px-3.5 py-3 transition-all duration-200 {{ request()->routeIs('admin.unit-posyandu.*') ? 'bg-blue-50 text-blue-700 font-bold border border-blue-100/50' : 'text-slate-500 hover:bg-slate-50 hover:text-blue-600 font-medium' }}"
           :class="sidebarCollapsed ? 'justify-center' : 'justify-start'" title="Unit Posyandu">
            <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1v1H9V7zm5 0h1v1h-1V7zm-5 4h1v1H9v-1zm5 0h1v1h-1v-1zm-3-4h2a2 2 0 012 2v14H9V9a2 2 0 012-2z"/></svg>
            <div class="transition-all duration-300 ease-in-out whitespace-nowrap overflow-hidden" 
                 :class="sidebarCollapsed ? 'w-0 opacity-0 ml-0' : 'w-[160px] opacity-100 ml-4'">
                Unit Posyandu
            </div>
        </a>

        <!-- Sistem Header -->
        <div class="mt-3 pt-3 border-t border-slate-100 transition-all duration-300 overflow-hidden" :class="sidebarCollapsed ? 'opacity-0 h-0 my-0 py-0' : 'opacity-100'">
            <p class="px-4 mb-2 text-[10px] font-bold tracking-widest text-slate-400 uppercase">Sistem Operasional</p>
        </div>

        <!-- Edukasi Kesehatan -->
        <a href="{{ route('admin.edukasi.index') }}" 
           class="flex items-center rounded-2xl px-3.5 py-3 transition-all duration-200 {{ request()->routeIs('admin.edukasi.*') ? 'bg-blue-50 text-blue-700 font-bold border border-blue-100/50' : 'text-slate-500 hover:bg-slate-50 hover:text-blue-600 font-medium' }}"
           :class="sidebarCollapsed ? 'justify-center' : 'justify-start'" title="Edukasi Kesehatan">
            <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
            <div class="transition-all duration-300 ease-in-out whitespace-nowrap overflow-hidden" 
                 :class="sidebarCollapsed ? 'w-0 opacity-0 ml-0' : 'w-[160px] opacity-100 ml-4'">
                Edukasi Kesehatan
            </div>
        </a>

        <!-- Log Aktivitas -->
        <a href="{{ route('admin.log-aktivitas.index') }}" 
           class="flex items-center rounded-2xl px-3.5 py-3 transition-all duration-200 {{ request()->routeIs('admin.log-aktivitas.*') ? 'bg-blue-50 text-blue-700 font-bold border border-blue-100/50' : 'text-slate-500 hover:bg-slate-50 hover:text-blue-600 font-medium' }}"
           :class="sidebarCollapsed ? 'justify-center' : 'justify-start'" title="Log Aktivitas">
            <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            <div class="transition-all duration-300 ease-in-out whitespace-nowrap overflow-hidden" 
                 :class="sidebarCollapsed ? 'w-0 opacity-0 ml-0' : 'w-[160px] opacity-100 ml-4'">
                Log Aktivitas
            </div>
        </a>

        <!-- Pengaturan -->
        <a href="{{ route('admin.pengaturan.index') }}" 
           class="flex items-center rounded-2xl px-3.5 py-3 transition-all duration-200 {{ request()->routeIs('admin.pengaturan.*') ? 'bg-blue-50 text-blue-700 font-bold border border-blue-100/50' : 'text-slate-500 hover:bg-slate-50 hover:text-blue-600 font-medium' }}"
           :class="sidebarCollapsed ? 'justify-center' : 'justify-start'" title="Pengaturan">
            <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
            <div class="transition-all duration-300 ease-in-out whitespace-nowrap overflow-hidden" 
                 :class="sidebarCollapsed ? 'w-0 opacity-0 ml-0' : 'w-[160px] opacity-100 ml-4'">
                Pengaturan
            </div>
        </a>
    </nav>

    <!-- Tombol Keluar Sesi -->
    <div class="p-4 mt-auto border-t border-slate-50 shrink-0">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="flex w-full items-center rounded-2xl bg-slate-50 border border-slate-100 px-3.5 py-3 text-sm font-bold text-slate-500 hover:bg-red-50 hover:text-red-600 transition-colors duration-200"
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