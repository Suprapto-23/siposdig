<header class="h-[76px] bg-white lg:rounded-3xl shadow-[0_4px_24px_rgba(37,99,235,0.03)] flex items-center justify-between px-4 lg:px-6 border-b lg:border border-slate-200/60 shrink-0 lg:m-4 lg:ml-6 lg:mb-6">
    
    <!-- Bagian Kiri: Tombol Toggle & Label -->
    <div class="flex items-center gap-4">
        
        <!-- Toggle Hide Sidebar Desktop -->
        <button @click="sidebarCollapsed = !sidebarCollapsed" class="hidden lg:flex text-slate-400 hover:text-blue-600 p-2.5 rounded-xl hover:bg-blue-50 transition-colors">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
        </button>
        
        <!-- Toggle Menu Mobile -->
        <button @click="mobileMenuOpen = true" class="lg:hidden text-slate-500 hover:text-blue-600 focus:outline-none p-1">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
        </button>
        
        <!-- Label Sistem -->
        <div class="hidden sm:flex items-center gap-2.5 px-3.5 py-2 rounded-xl bg-blue-50/50 text-blue-700 text-xs font-bold tracking-wide border border-blue-100">
            <span class="h-2 w-2 rounded-full bg-blue-600 animate-pulse"></span>
            Sistem Operasional Aktif
        </div>
    </div>

    <!-- Bagian Kanan: Pencarian & Profil -->
    <div class="flex items-center gap-5">
        
        <!-- Kolom Pencarian -->
        <div class="relative hidden md:block w-72">
            <svg class="absolute left-4 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
            <input type="text" placeholder="Cari NIK, Nama Warga, atau Posyandu..." class="w-full rounded-2xl border border-slate-200 bg-slate-50/50 py-2.5 pl-11 pr-4 text-xs text-slate-700 placeholder-slate-400 focus:border-blue-500 focus:bg-white focus:outline-none focus:ring-4 focus:ring-blue-500/10 transition-all">
        </div>

        <div class="w-px h-8 bg-slate-200 hidden md:block"></div>

        <!-- Info Profil -->
        <div class="flex items-center gap-3 cursor-pointer group">
            <div class="text-right hidden md:block">
                <p class="text-[13px] font-bold text-slate-900 leading-none group-hover:text-blue-600 transition-colors">Administrator</p>
                <p class="text-[10px] font-bold text-slate-400 mt-1 uppercase tracking-wider">Super Admin</p>
            </div>
            <img src="https://ui-avatars.com/api/?name=Admin+SIPOSDIG&background=2563EB&color=fff&rounded=true&bold=true" alt="Avatar" class="h-10 w-10 rounded-xl shadow-sm border border-slate-100">
        </div>
    </div>
</header>