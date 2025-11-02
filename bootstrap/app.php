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
        // Register custom middleware aliases
        $middleware->alias([
            'role' => \App\Http\Middleware\CheckRole::class,
        ]);

        // Web middleware group customization
        $middleware->web(append: [
            \Illuminate\Session\Middleware\StartSession::class,
        ]);

        // Authenticate session for security
        // $middleware->authenticateSession();
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
