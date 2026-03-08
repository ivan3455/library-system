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

// ТІЛЬКИ після логіну
Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/authors', [AuthorController::class, 'index'])->name('authors.index');
    Route::get('/books', [BookController::class, 'index'])->name('books.index');

    Route::middleware(['admin'])->group(function () {
        Route::resource('authors', AuthorController::class)->except(['index', 'show']);
        Route::resource('books', BookController::class)->except(['index', 'show']);
    });

    Route::get('/authors/{author}', [AuthorController::class, 'show'])->name('authors.show');
    Route::get('/books/{book}', [BookController::class, 'show'])->name('books.show');
});

require __DIR__.'/auth.php';
