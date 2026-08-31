<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard - SIPOSDIG')</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Plus+Jakarta+Sans:wght@500;600;700;800&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>

    <style>
        .custom-scrollbar::-webkit-scrollbar { width: 5px; height: 5px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #BFDBFE; border-radius: 10px; }
        .custom-scrollbar::-webkit-scrollbar-thumb:hover { background: #60A5FA; }
        [x-cloak] { display: none !important; }
    </style>
</head>

<!-- x-data mengontrol seluruh komponen di dalamnya -->
<body x-data="{ mobileMenuOpen: false, sidebarCollapsed: false }" class="bg-[#F8FAFC] font-body text-slate-800 antialiased h-screen flex overflow-hidden">

    <!-- Overlay Gelap untuk Mobile -->
    <div x-show="mobileMenuOpen" x-cloak x-transition.opacity class="fixed inset-0 z-40 bg-slate-900/40 backdrop-blur-sm lg:hidden" @click="mobileMenuOpen = false"></div>

    <!-- Panggil Komponen Sidebar -->
    <x-sidebar.sidebar-admin />

    <!-- Pembungkus Area Kanan (Navbar + Konten) -->
    <div class="flex-1 flex flex-col h-screen min-w-0 overflow-hidden">
        
        <!-- Panggil Komponen Navbar -->
        <x-navbar.navbar-admin />

        <!-- Area Konten Utama -->
        <main class="flex-1 overflow-y-auto px-4 lg:px-6 pb-6 custom-scrollbar">
            @yield('content')
        </main>
    </div>

</body>
</html>