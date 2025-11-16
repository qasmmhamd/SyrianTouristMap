<?php

use Illuminate\Foundation\Application;
use App\Http\Middleware\CheckRole;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Middleware\HandleCors;
use Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        api:__DIR__.'/../routes/api.php',
        health: '/up',
    )

//    ->withMiddleware(function (Middleware $middleware) {
//     // ميدل وير عامة (تنفذ بكل الطلبات)
//     $middleware->use([
//         \Illuminate\Http\Middleware\HandleCors::class,
//         \Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful::class,
//     ]);

//     // مجموعات
//     $middleware->group('api', [
//         \Illuminate\Http\Middleware\HandleCors::class,
//     ]);

//     // aliases
//     $middleware->alias([
//         'checkRole' => \App\Http\Middleware\CheckRole::class,
//         'SuperAdmin' => \App\Http\Middleware\SuperAdminMiddleware::class,
//     ]);

//     // استثناءات من CSRF
//     $middleware->validateCsrfTokens(except: [
//         'api/*',
//         '/api/*',
//     ]);
// })

// ->withMiddleware(function (Middleware $middleware) {
//     // run CORS before everything else
//     $middleware->prepend(HandleCors::class);
// });


->withMiddleware(function (Middleware $middleware) {
    // $middleware->appendToGroup('api', HandleCors::class);
         $middleware->prepend(HandleCors::class);
        
        
        $middleware->use([
            EnsureFrontendRequestsAreStateful::class,
        ]);
         $middleware->alias([
            'checkRole' => CheckRole::class,
        ]);
         $middleware->validateCsrfTokens(except: [
        
          'api/*',
          '/api/*',

          
    ]);
    $middleware->alias([
       'SuperAdmin' => \App\Http\Middleware\SuperAdminMiddleware::class,
    ]);
    
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
