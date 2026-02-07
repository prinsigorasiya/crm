<?php

use App\Http\Middleware\LogRoute;
use App\Http\Middleware\TrustProxies;
use App\Http\Middleware\XssSanitization;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->append(LogRoute::class);
        $middleware->append(XssSanitization::class);
        $middleware->append(TrustProxies::class);
        //$middleware->append(UserAuthentication::class);
    })
    ->withExceptions(function (Exceptions $exceptions) {})->create();
