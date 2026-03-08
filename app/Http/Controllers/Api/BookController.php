<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Http\Resources\BookResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::with('author')->get();
        return BookResource::collection($books);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'author_id'      => 'required|exists:authors,id',
            'title'          => 'required|string|max:255',
            'isbn'           => 'required|string|unique:books,isbn',
            'published_year' => 'required|integer|min:1000|max:' . date('Y'),
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $book = Book::create($request->all());

        return new BookResource($book->load('author'));
    }

    public function show(Book $book)
    {
        return new BookResource($book->load('author'));
    }

    public function update(Request $request, Book $book)
    {
        $validator = Validator::make($request->all(), [
            'author_id'      => 'sometimes|required|exists:authors,id',
            'title'          => 'sometimes|required|string|max:255',
            'isbn'           => 'sometimes|required|string|unique:books,isbn,' . $book->id,
            'published_year' => 'sometimes|required|integer|min:1000|max:' . date('Y'),
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $book->update($request->all());

        return new BookResource($book->load('author'));
    }

    public function destroy(Book $book)
    {
        $book->delete();

        return response()->json([
            'message' => 'Book deleted successfully'
        ], 200);
    }
}
