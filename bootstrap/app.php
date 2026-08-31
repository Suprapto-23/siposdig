<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        //
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
    ->withRouting(
    web: __DIR__.'/../routes/web.php',
    then: function () {
        Route::middleware('web')->group(base_path('routes/auth.php'));
        Route::middleware(['web', 'auth:admin'])->prefix('admin')->group(base_path('routes/admin.php'));
        Route::middleware(['web', 'auth:kader'])->prefix('kader')->group(base_path('routes/kader.php'));
        Route::middleware(['web', 'auth:warga'])->prefix('warga')->group(base_path('routes/warga.php'));
    },
)
