<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'SIPOSDIG') }} - Sistem Informasi Posyandu Digital</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Plus+Jakarta+Sans:wght@600;700&display=swap" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- Alpine.js & Lottie -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.13.3/dist/cdn.min.js"></script>
    <script type="module" src="https://unpkg.com/@lottiefiles/dotlottie-wc@0.3.0/dist/dotlottie-wc.js"></script>
    
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        .font-jakarta { font-family: 'Plus Jakarta Sans', sans-serif; }
        .font-inter { font-family: 'Inter', sans-serif; }
        
        /* Premium Glassmorphism khusus Auth */
        .glass-card {
            background: rgba(255, 255, 255, 0.55);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.6);
            box-shadow: 0 8px 32px rgba(37, 99, 235, 0.08);
        }
        
        /* Solid input untuk aksesibilitas WCAG */
        .glass-input {
            background: rgba(255, 255, 255, 0.92);
        }

        /* Dekorasi Background Blob */
        .bg-blob-1 {
            background: radial-gradient(circle, rgba(219,234,254,1) 0%, rgba(255,255,255,0) 60%);
        }
        .bg-blob-2 {
            background: radial-gradient(circle, rgba(224,242,254,1) 0%, rgba(255,255,255,0) 60%);
        }
    </style>
</head>
<body class="font-inter text-slate-900 antialiased bg-slate-50 relative min-h-screen overflow-x-hidden selection:bg-blue-200 selection:text-blue-900">
    
    <!-- Background Blobs -->
    <div class="fixed top-[-10%] left-[-10%] w-[50vw] h-[50vw] bg-blob-1 opacity-70 pointer-events-none -z-10 animate-pulse" style="animation-duration: 8s;"></div>
    <div class="fixed bottom-[-10%] right-[-10%] w-[60vw] h-[60vw] bg-blob-2 opacity-70 pointer-events-none -z-10 animate-pulse" style="animation-duration: 12s;"></div>

    <div class="min-h-screen flex flex-col justify-center items-center p-4 sm:p-6 lg:p-8">
        {{ $slot }}
    </div>

    <!-- Premium Toast Alert Configuration -->
    <script>
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 4000,
            timerProgressBar: true,
            customClass: {
                popup: 'glass-card !rounded-2xl !p-2 !mt-4 !mr-4',
                title: 'font-jakarta !text-slate-800 !text-sm !font-semibold',
                timerProgressBar: '!bg-blue-500'
            },
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        });

        @if(session('success'))
            Toast.fire({ icon: 'success', title: "{{ session('success') }}" });
        @endif

        @if(session('error'))
            Toast.fire({ icon: 'error', title: "{{ session('error') }}" });
        @endif

        @if($errors->any())
            Toast.fire({ icon: 'error', title: "Terjadi kesalahan pada input data." });
        @endif
    </script>
</body>
</html>