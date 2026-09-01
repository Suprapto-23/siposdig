<header class="h-[80px] bg-white lg:rounded-[2rem] shadow-sm flex items-center justify-between px-4 lg:px-6 border-b lg:border border-slate-200/60 shrink-0 lg:my-4 lg:ml-4 lg:mr-4 z-20">
    
    <div class="flex items-center gap-4">
        <!-- Toggle Collapse Desktop -->
        <button @click="sidebarCollapsed = !sidebarCollapsed" class="hidden lg:flex text-slate-400 hover:text-blue-600 p-2.5 rounded-xl hover:bg-blue-50 transition-colors focus:outline-none">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
        </button>
        
        <!-- Toggle Mobile -->
        <button @click="mobileMenuOpen = true" class="lg:hidden text-slate-500 hover:text-blue-600 focus:outline-none p-2.5 rounded-xl hover:bg-slate-50">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
        </button>
        
        <div class="hidden sm:flex items-center gap-2.5 px-3.5 py-2 rounded-xl bg-emerald-50/50 text-emerald-700 text-xs font-bold tracking-wide border border-emerald-100">
            <span class="h-2 w-2 rounded-full bg-emerald-500 animate-pulse"></span>
            Sistem Operasional Aktif
        </div>
    </div>

    <div class="flex items-center gap-5">
        <div class="relative hidden md:block w-72">
            <svg class="absolute left-4 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
            <input type="text" placeholder="Cari NIK, Nama Warga, atau Posyandu..." class="w-full rounded-2xl border border-slate-200 bg-slate-50/50 py-2.5 pl-11 pr-4 text-xs font-medium text-slate-700 placeholder-slate-400 focus:border-blue-500 focus:bg-white focus:outline-none focus:ring-4 focus:ring-blue-500/10 transition-all">
        </div>

        <div class="w-px h-8 bg-slate-200 hidden md:block"></div>

        <div class="flex items-center gap-3 cursor-pointer group">
            <div class="text-right hidden md:block">
                <p class="text-[13px] font-bold text-slate-900 leading-none group-hover:text-blue-600 transition-colors">{{ auth('admin')->user()->name ?? 'Administrator' }}</p>
                <p class="text-[10px] font-bold text-slate-400 mt-1 uppercase tracking-wider">Super Admin</p>
            </div>
            <div class="h-11 w-11 rounded-2xl shadow-sm border border-slate-200 bg-slate-100 flex items-center justify-center text-slate-600 font-bold overflow-hidden">
                <img src="https://ui-avatars.com/api/?name=Admin+SIPOSDIG&background=f8fafc&color=475569&bold=true" class="w-full h-full object-cover">
            </div>
        </div>
    </div>
</header>