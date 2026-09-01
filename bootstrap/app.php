<?php
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // Redirect logic jika user belum login (dilempar ke route 'login')
        $middleware->redirectGuestsTo('/login');

        // Redirect logic jika user SUDAH login tapi mencoba akses halaman login lagi
        $middleware->redirectUsersTo(function (Request $request) {
            if (auth('admin')->check()) return '/admin/dashboard';
            if (auth('kader')->check()) return '/kader/dashboard';
            if (auth('warga')->check()) return '/warga/dashboard';
            
            return '/home';
        });
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();