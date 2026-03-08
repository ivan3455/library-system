<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;

Route::get('/', function () {
    return view('welcome');
});

// Перемикач мов
Route::get('lang/{locale}', function ($locale) {
    if (in_array($locale, ['en', 'uk'])) {
        session(['locale' => $locale]);
        session()->save();
    }
    return redirect()->back();
})->name('lang.switch');

// 1. ВИДАЛЯЄМО 'verified', щоб пошта не блокувала вхід
Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // 2. ПЕРЕМІЩУЄМО всі маршрути авторів та книг СЮДИ (поза межі 'admin')
    // Це дозволить перевірити, чи працюють вони хоча б для звичайного логіну
    Route::resource('authors', AuthorController::class);
    Route::resource('books', BookController::class);

    // Ці рядки можна поки що закоментувати, бо resource вище покриває їх
    // Route::get('/authors/{author}', [AuthorController::class, 'show'])->name('authors.show');
    // Route::get('/books/{book}', [BookController::class, 'show'])->name('books.show');
});

require __DIR__.'/auth.php';
