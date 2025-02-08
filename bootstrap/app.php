<?php
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\ApiTokenMiddleware;
use App\Http\Middleware\CorsMiddleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // $middleware->append(ApiTokenMiddleware::class); // Register API Token Middleware
        $middleware->append(CorsMiddleware::class,'handle'); // Register API Token Middleware
        $middleware->alias([
            \App\Http\Middleware\CorsMiddleware::class,
          ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
