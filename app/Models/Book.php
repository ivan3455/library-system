<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'author_id',
        'title',
        'description',
        'isbn',
        'published_year',
    ];

    // Belongs To автор, який написав книгу
    public function author()
    {
        return $this->belongsTo(Author::class);
    }
}
