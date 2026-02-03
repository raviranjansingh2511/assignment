<?php

use Illuminate\Foundation\Application;
use App\Http\Middleware\IsAdmin;
use App\Http\Middleware\Isnotadmin;
use App\Http\Middleware\userApiAuth;
use App\Http\Middleware\CheckSuperAdmin;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
            'ifadmin' => IsAdmin::class,
            'ifnotadmin' => Isnotadmin::class,
            'checkSuperAdmin' => CheckSuperAdmin::class,
        ]);
    })
    ->withExceptions(function ($exceptions): void {
        //
    })
    ->create();
