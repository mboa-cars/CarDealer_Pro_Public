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
        $middleware->alias([
            'security.headers' => \App\Http\Middleware\SecurityHeaders::class,
            'admin' => \App\Http\Middleware\AdminMiddleware::class,
            'bookmark' => \App\Http\Middleware\BookmarkMiddleware::class,
        ]);
        
        // Appliquer le middleware bookmark globalement
        $middleware->append(\App\Http\Middleware\BookmarkMiddleware::class);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
