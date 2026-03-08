<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\AuthorController;
use App\Http\Controllers\Api\BookController;
use Illuminate\Support\Facades\Route;

// Маршрути реєстрації та логіну для Angular (API)
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);

    // Додаємо .names(), щоб імена не конфліктували з Blade-маршрутами
    Route::apiResource('authors', AuthorController::class)->names([
        'index'   => 'api.authors.index',
        'store'   => 'api.authors.store',
        'show'    => 'api.authors.show',
        'update'  => 'api.authors.update',
        'destroy' => 'api.authors.destroy',
    ]);

    Route::apiResource('books', BookController::class)->names([
        'index'   => 'api.books.index',
        'store'   => 'api.books.store',
        'show'    => 'api.books.show',
        'update'  => 'api.books.update',
        'destroy' => 'api.books.destroy',
    ]);
});
