<header class="h-[80px] bg-white/90 backdrop-blur-xl lg:rounded-[2rem] shadow-[0_4px_24px_rgba(37,99,235,0.03)] flex items-center justify-between px-4 lg:px-6 border-b lg:border border-slate-200/60 shrink-0 lg:my-4 lg:ml-4 lg:mr-4 z-20 transition-all">
    
    <!-- Kiri: Toggle & Status -->
    <div class="flex items-center gap-4">
        <!-- Desktop Toggle -->
        <button @click="sidebarCollapsed = !sidebarCollapsed" class="hidden lg:flex text-slate-400 hover:text-blue-600 p-2.5 rounded-xl hover:bg-blue-50 transition-colors focus:outline-none">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 6h16M4 12h16M4 18h16"/></svg>
        </button>
        
        <!-- Mobile Toggle -->
        <button @click="mobileMenuOpen = true" class="lg:hidden text-slate-500 hover:text-blue-600 focus:outline-none p-2.5 rounded-xl hover:bg-slate-50 transition-colors">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 6h16M4 12h16M4 18h16"/></svg>
        </button>
        
        <!-- Status Operasional (Blue Tint) -->
        <div class="hidden sm:flex items-center gap-2.5 px-3.5 py-2 rounded-xl bg-blue-50/80 text-blue-700 text-[11px] font-extrabold tracking-wide border border-blue-100/50 uppercase">
            <span class="h-2 w-2 rounded-full bg-blue-500 animate-pulse"></span>
            Siap Melayani
        </div>
    </div>

    <!-- Kanan: Profil Kader -->
    <div class="flex items-center gap-5">
        
        <!-- Info Profil -->
        <div class="flex items-center gap-3 cursor-pointer group">
            <div class="text-right hidden md:block">
                <p class="text-[13px] font-bold text-slate-800 leading-none group-hover:text-blue-600 transition-colors">{{ auth('kader')->user()->nama ?? 'Kader Posyandu' }}</p>
                <p class="text-[10px] font-bold text-slate-400 mt-1.5 uppercase tracking-wider">Kader Unit Aktif</p>
            </div>
            
            <div class="h-11 w-11 rounded-2xl shadow-sm border border-slate-200/60 bg-gradient-to-br from-slate-50 to-slate-100 flex items-center justify-center text-slate-600 font-bold overflow-hidden transition-transform group-hover:scale-105">
                <!-- Fallback Avatar menggunakan inisial nama, background disesuaikan menjadi Blue (2563EB) -->
                <img src="https://ui-avatars.com/api/?name={{ urlencode(auth('kader')->user()->nama ?? 'Kader') }}&background=2563EB&color=fff&bold=true" class="w-full h-full object-cover">
            </div>
        </div>
    </div>
</header>