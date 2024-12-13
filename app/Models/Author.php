<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    /**
     * Relasi ke model Book.
     * Seorang author memiliki banyak buku (one-to-many).
     */
    public function books()
    {
        return $this->hasMany(Book::class, 'author_id');
    }
}
