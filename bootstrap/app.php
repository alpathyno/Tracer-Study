<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Support\Facades\Auth;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        // No-cache GLOBAL — berlaku untuk semua halaman
        $middleware->append(\App\Http\Middleware\NoCacheHeaders::class);

        // Redirect guest & authenticated users
        $middleware->redirectGuestsTo(fn () => route('login'));

        $middleware->redirectUsersTo(function () {
            if (Auth::check()) {
                if (Auth::user()->role === 'admin') {
                    return route('admin.dashboard');
                }
                return route('alumni.dashboard');
            }
            return route('landing');
        });
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();