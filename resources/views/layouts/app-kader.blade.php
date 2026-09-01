<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Kader - SIPOSDIG')</title>
    
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Plus+Jakarta+Sans:wght@600;700;800&display=swap" rel="stylesheet">
    
    <!-- Scripts & Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- Alpine.js, Lottie & SweetAlert2 -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.13.3/dist/cdn.min.js"></script>
    <script type="module" src="https://unpkg.com/@lottiefiles/dotlottie-wc@0.3.0/dist/dotlottie-wc.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <style>
        .font-jakarta { font-family: 'Plus Jakarta Sans', sans-serif; }
        .font-inter { font-family: 'Inter', sans-serif; }
        .custom-scrollbar::-webkit-scrollbar { width: 4px; height: 4px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; }
        .custom-scrollbar:hover::-webkit-scrollbar-thumb { background: #94a3b8; }
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="font-inter text-slate-900 antialiased bg-[#F4F8FB] overflow-hidden" 
      x-data="{ sidebarCollapsed: false, mobileMenuOpen: false }">
    
    <div class="flex h-screen w-full relative">
        
        <!-- Panggil Sidebar Kader -->
        @include('components.sidebar.sidebar-kader')

        <!-- Main Wrapper -->
        <div class="flex-1 flex flex-col h-screen overflow-hidden min-w-0 transition-all duration-300">
            
            <!-- Panggil Navbar Kader -->
            @include('components.navbar.navbar-kader')

            <!-- Main Content Area -->
            <main class="flex-1 overflow-y-auto overflow-x-hidden p-4 sm:p-6 lg:p-8 custom-scrollbar relative z-0">
                @yield('content')
            </main>
        </div>
    </div>

    <!-- Alert Global System -->
    <script>
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 4000,
            timerProgressBar: true,
            customClass: {
                popup: '!rounded-2xl !p-2 !mt-4 !mr-4 border border-slate-100 shadow-lg',
                title: 'font-jakarta !text-slate-800 !text-sm !font-semibold',
            }
        });
        @if(session('success')) Toast.fire({ icon: 'success', title: "{{ session('success') }}" }); @endif
        @if(session('error')) Toast.fire({ icon: 'error', title: "{{ session('error') }}" }); @endif
    </script>
</body>
</html>