<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'author_id', 'category_id'
    ];

    /**
     * Eager load relasi author dan category secara default.
     */
    protected $with = ['author', 'category'];

    /**
     * Relasi ke model Author.
     * Buku dimiliki oleh satu penulis (many-to-one).
     */
    public function author()
    {
        return $this->belongsTo(Author::class, 'author_id');
    }

    /**
     * Relasi ke model BookCategory.
     * Buku memiliki satu kategori (many-to-one).
     */
    public function category()
    {
        return $this->belongsTo(BookCategory::class, 'category_id');
    }

    /**
     * Relasi ke model Rating.
     * Buku dapat memiliki banyak rating (one-to-many).
     */
    public function ratings()
    {
        return $this->hasMany(Rating::class, 'book_id');
    }

    /**
     * Rata-rata rating buku.
     */
    public function averageRating()
    {
        return $this->ratings()->avg('rating');
    }
}
