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
        // Register route middleware aliases used in routes/web.php
        $middleware->alias([
            'auth' => 'App\\Http\\Middleware\\Authenticate',
            'role' => 'App\\Http\\Middleware\\EnsureRole',
            'auth.student' => 'App\\Http\\Middleware\\AuthenticateStudent',
            'auth.instructor' => 'App\\Http\\Middleware\\AuthenticateInstructor',
            'auth.admin' => 'App\\Http\\Middleware\\AuthenticateAdmin',
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
