<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Author;
use App\Http\Resources\AuthorResource;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    public function index()
    {
        return AuthorResource::collection(Author::all());
    }

    public function store(Request $request)
    {
        $validated = $request->validate(['name' => 'required|string', 'bio' => 'nullable']);
        $author = Author::create($validated);
        return new AuthorResource($author);
    }

    public function show(Author $author)
    {
        return new AuthorResource($author);
    }

    public function update(Request $request, Author $author)
    {
        $author->update($request->all());
        return new AuthorResource($author);
    }

    public function destroy(Author $author)
    {
        $author->delete();
        return response()->json(['message' => 'Deleted successfully']);
    }
}
