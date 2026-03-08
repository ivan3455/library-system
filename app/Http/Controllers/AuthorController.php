<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $authors = Author::all();

        return view('authors.index', compact('authors'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('authors.create');
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // якщо дані не пройдуть перевірку, Laravel поверне користувача назад на форму з помилками
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'bio' => 'nullable|string',
            'birth_date' => 'nullable|date',
        ]);

        Author::create($validatedData);

        return redirect()->route('authors.index')->with('success', 'Автора успішно додано!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Author $author)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Author $author)
    {
        return view('authors.edit', compact('author'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Author $author)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'bio' => 'nullable|string',
            'birth_date' => 'nullable|date',
        ]);

        $author->update($validatedData);

        return redirect()->route('authors.index')->with('success', 'Дані автора оновлено!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Author $author)
    {
        $author->delete();

        return redirect()->route('authors.index')->with('success', 'Автора видалено.');
    }
}
