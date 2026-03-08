<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    use HasFactory;

    // масив $fillable дозволяє захистити базу від сторонніх даних
    // це ті поля, які користувач може вводити в формах
    protected $fillable = [
        'name',
        'bio',
        'birth_date',
    ];

    // один до багатьох
    public function books()
    {
        return $this->hasMany(Book::class);
    }
}
