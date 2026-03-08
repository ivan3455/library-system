<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {

        // Переконаємося, що веб-група працює стандартно
        $middleware->web(append: [
            \App\Http\Middleware\SetLocale::class,
        ]);

        // Реєструємо аліаси
        $middleware->alias([
            'admin' => \App\Http\Middleware\AdminMiddleware::class,
        ]);

        // ВАЖЛИВО: Видаляємо будь-які налаштування stateful для API,
        // які могли бути додані раніше для Angular
        $middleware->statefulApi();

    })
    ->withExceptions(function (Exceptions $exceptions) {
        // Тут можна додати обробку редіректів, якщо сесія закінчилася
    })->create();
