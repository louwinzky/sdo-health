<?php

use App\Http\Middleware\RedirectIfUnapproved;
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
<<<<<<< Updated upstream
        //
=======
        $middleware->web(append: [
            RedirectIfUnapproved::class,
        ]);
>>>>>>> Stashed changes
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
