<header class="h-[76px] bg-white md:rounded-[24px] shadow-[0_8px_32px_rgba(37,99,235,0.03)] flex items-center justify-between px-4 md:px-6 border-b md:border border-slate-100 shrink-0">
    
    <!-- Bagian Kiri: Hamburger Menu & Indikator Unit -->
    <div class="flex items-center gap-4">
        <button @click="sidebarOpen = true" class="md:hidden text-slate-500 hover:text-blue-600 focus:outline-none">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
        </button>
        
        <div class="hidden md:flex items-center gap-2.5 px-3 py-1.5 rounded-xl border border-blue-100 bg-blue-50/50 text-blue-700 text-sm font-semibold">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.243-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
            Posyandu Digital Terpadu
            <svg class="w-3.5 h-3.5 ml-1 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
        </div>
    </div>

    <!-- Bagian Kanan: Pencarian, Notifikasi, Profil -->
    <div class="flex items-center gap-4 md:gap-6">
        
        <!-- Search Input -->
        <div class="relative hidden lg:block w-72">
            <svg class="absolute left-3.5 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
            <input type="text" placeholder="Cari data, warga, posyandu..." class="w-full rounded-xl border border-slate-200 bg-slate-50 py-2.5 pl-10 pr-12 text-sm text-slate-700 placeholder-slate-400 focus:border-blue-500 focus:bg-white focus:outline-none focus:ring-4 focus:ring-blue-500/10 transition-all">
            <div class="absolute right-2.5 top-1/2 -translate-y-1/2 flex items-center gap-1 rounded-md border border-slate-200 px-1.5 py-0.5 text-[10px] font-bold text-slate-400 bg-white shadow-sm">
                <span>⌘</span><span>K</span>
            </div>
        </div>

        <!-- Tombol Notifikasi -->
        <button class="relative text-slate-400 hover:text-blue-600 transition-colors p-1.5 rounded-full hover:bg-blue-50">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/></svg>
            <span class="absolute top-1 right-1 flex h-4 w-4 items-center justify-center rounded-full bg-blue-600 text-[9px] font-bold text-white border-2 border-white">3</span>
        </button>

        <!-- Profil -->
        <div class="flex items-center gap-3 cursor-pointer pl-4 border-l border-slate-200 hover:opacity-80 transition-opacity">
            <img src="https://ui-avatars.com/api/?name=Admin+SIPOSDIG&background=2563EB&color=fff&rounded=true&bold=true" alt="Avatar" class="h-9 w-9 rounded-full shadow-sm">
            <div class="hidden md:block text-left">
                <p class="text-sm font-bold text-slate-900 leading-none">Administrator SIPOSDIG</p>
                <p class="text-[11px] font-semibold text-slate-500 mt-1 uppercase tracking-wider">Admin</p>
            </div>
            <svg class="hidden md:block w-4 h-4 text-slate-400 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
        </div>
    </div>
</header>