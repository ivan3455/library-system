<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Author;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // with('author') для завантаження даних автора (Eager Loading)
        // це економить ресурси бази даних
        $books = Book::with('author')->get();
        return view('books.index', compact('books'));
    }

    public function create()
    {
        $authors = Author::all(); // отримуємо всіх авторів для випадаючого списку
        return view('books.create', compact('authors'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'author_id' => 'required|exists:authors,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'isbn' => 'required|string|unique:books,isbn',
            'published_year' => 'required|integer|min:1000|max:' . (date('Y') + 1),
        ]);

        Book::create($validated);

        return redirect()->route('books.index')->with('success', 'Книгу успішно додано!');
    }

    public function show(Book $book)
    {
        //
    }

    public function edit(Book $book)
    {
        $authors = Author::all();
        return view('books.edit', compact('book', 'authors'));
    }

    public function update(Request $request, Book $book)
    {
        $validated = $request->validate([
            'author_id' => 'required|exists:authors,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'isbn' => 'required|string|unique:books,isbn,' . $book->id,
            'published_year' => 'required|integer|min:1000|max:' . (date('Y') + 1),
        ]);

        $book->update($validated);

        return redirect()->route('books.index')->with('success', 'Дані книги оновлено!');
    }

    public function destroy(Book $book)
    {
        $book->delete();
        return redirect()->route('books.index')->with('success', 'Книгу видалено.');
    }
}
