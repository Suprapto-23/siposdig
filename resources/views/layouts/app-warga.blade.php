<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'SIPOSDIG - Portal Warga')</title>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Vite CSS & JS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body { 
            font-family: 'Plus Jakarta Sans', sans-serif; 
            background-color: #f8fafc; 
        }
        /* Menyembunyikan scrollbar bawaan agar terasa seperti aplikasi asli */
        .custom-scrollbar::-webkit-scrollbar { display: none; } 
        .custom-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
    </style>
</head>
<body class="antialiased text-slate-800 selection:bg-blue-500 selection:text-white flex justify-center min-h-screen">

    <!-- Mobile App Shell Container -->
    <div class="w-full max-w-md bg-white min-h-screen relative shadow-2xl flex flex-col overflow-hidden pb-6">
        
        <!-- Memanggil Top Navbar -->
        @include('components.navbar.navbar-warga')

        <!-- Area Konten Utama (Bisa di-scroll) -->
        <main class="flex-1 overflow-y-auto custom-scrollbar p-6">
            
            <!-- Global Alert -->
            @if(session('success'))
                <div class="mb-6 p-4 bg-emerald-50 border border-emerald-100 text-emerald-700 text-xs font-bold rounded-2xl flex items-center gap-3 animate-fade-in">
                    <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            <!-- Konten Dinamis -->
            @yield('content')
            
        </main>

        <!-- Memanggil Bottom Navigation -->
        @include('components.sidebar.sidebar-warga')

    </div>

</body>
</html>