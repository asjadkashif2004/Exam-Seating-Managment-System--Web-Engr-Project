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
    ->withMiddleware(function (Middleware $middleware): void {
        // Register route middleware aliases here (Laravel 11/12)
        $middleware->alias([
            'role' => \App\Http\Middleware\RoleMiddleware::class, // 👈 important
        ]);

        // (optional) groups you can use in routes:
        // $middleware->group('admin-only',  ['auth', 'role:admin']);
        // $middleware->group('staff-only',  ['auth', 'role:staff']);
        // $middleware->group('student-only',['auth', 'role:student']);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })
    ->create();
