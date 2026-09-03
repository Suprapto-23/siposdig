<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Portal Warga - SIPOSDIG')</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .custom-scrollbar::-webkit-scrollbar { width: 4px; height: 4px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 9999px; }
    </style>
</head>
<body x-data="{ sidebarOpen: window.innerWidth >= 1024 }" 
      @resize.window="sidebarOpen = window.innerWidth >= 1024"
      class="bg-slate-50 min-h-screen text-slate-800 antialiased selection:bg-blue-500 selection:text-white flex overflow-x-hidden">

    <!-- OVERLAY MOBILE -->
    <div x-show="sidebarOpen" 
         x-transition.opacity 
         @click="sidebarOpen = false" 
         class="fixed inset-0 bg-slate-900/40 backdrop-blur-sm z-40 lg:hidden cursor-pointer">
    </div>

    <!-- SIDEBAR MENGAMBANG -->
    @include('components.sidebar.sidebar-warga')

    <!-- AREA KONTEN DENGAN SPASI LEBIH LUAS -->
    <div :class="sidebarOpen ? 'lg:ml-[350px] lg:pr-8' : 'ml-0 lg:px-8'" 
         class="flex-1 flex flex-col min-h-screen transition-all duration-500 ease-in-out w-full px-4 sm:px-6">
        
        <!-- NAVBAR MENGAMBANG -->
        @include('components.navbar.navbar-warga')

        <!-- KONTEN HALAMAN -->
        <main class="flex-1 py-8 pb-16 w-full max-w-full overflow-hidden">
            @if(session('success'))
                <div class="mb-6 p-4 bg-emerald-50 border border-emerald-100 text-emerald-700 text-sm font-bold rounded-2xl flex items-center gap-3 animate-fade-in shadow-sm">
                    <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            @yield('content')
        </main>
    </div>

</body>
</html>