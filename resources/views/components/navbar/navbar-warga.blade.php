<header class="sticky top-4 lg:top-6 z-30 mt-4 lg:mt-6 bg-white/80 backdrop-blur-2xl border border-white px-4 lg:px-6 py-3 lg:py-4 flex items-center justify-between rounded-[1.5rem] lg:rounded-[2rem] shadow-[0_8px_30px_rgba(37,99,235,0.04)] transition-all duration-500">
    <div class="flex items-center gap-3 lg:gap-4">
        
        <!-- TOMBOL TOGGLE SIDEBAR -->
        <button @click="sidebarOpen = !sidebarOpen" class="p-2 lg:p-2.5 bg-blue-50 hover:bg-blue-100 text-blue-600 rounded-xl transition-all shadow-sm focus:outline-none">
            <svg class="w-5 h-5 transition-transform duration-500" :class="sidebarOpen ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 6h16M4 12h16M4 18h16"/>
            </svg>
        </button>

        <!-- Status Aktif (Sembunyi di HP kecil agar tidak sempit) -->
        <div class="hidden sm:flex items-center gap-2 lg:gap-3 bg-blue-50/70 border border-blue-100/80 px-3 lg:px-4 py-1.5 lg:py-2 rounded-xl lg:rounded-2xl">
            <span class="w-2 h-2 lg:w-2.5 lg:h-2.5 rounded-full bg-blue-500 animate-pulse"></span>
            <span class="text-[10px] lg:text-xs font-extrabold text-blue-700 tracking-wide">Layanan Aktif</span>
        </div>
    </div>

    <!-- Profil Kanan -->
    <div class="flex items-center gap-3">
        <div class="text-right hidden sm:block">
            <h3 class="text-xs font-black text-slate-800">{{ auth('warga')->user()->nama_lengkap ?? 'Warga' }}</h3>
            <p class="text-[10px] font-extrabold text-slate-400 uppercase tracking-widest">NIK: {{ auth('warga')->user()->nik ?? '-' }}</p>
        </div>
        <a href="{{ route('warga.profil.index') }}" class="w-9 h-9 lg:w-11 lg:h-11 rounded-xl lg:rounded-2xl bg-gradient-to-tr from-blue-600 to-sky-400 text-white flex items-center justify-center font-black shadow-md uppercase shrink-0 hover:scale-105 transition-transform cursor-pointer">
            {{ substr(auth('warga')->user()->nama_lengkap ?? 'W', 0, 1) }}
        </a>
    </div>
</header>