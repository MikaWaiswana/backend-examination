<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Author;
use App\Models\Book;
use App\Models\Rating;

class RatingController extends Controller
{
    // Form untuk membuat rating
    public function create()
    {
        $authors = Author::with('books')->get();
        return view('ratings.create', compact('authors'));
    }

    // Proses penyimpanan rating baru
    public function store(Request $request)
    {
        $request->validate([
            'book_id' => 'required|exists:books,id',
            'rating' => 'required|integer|min:1|max:10',
        ]);

        Rating::create([
            'book_id' => $request->book_id,
            'rating' => $request->rating,
        ]);

        return redirect()->route('books.index')->with('success', 'Rating submitted successfully');
    }

    // Ambil buku berdasarkan author
    public function getBooks($author_id)
    {
        $books = Book::where('author_id', $author_id)->get();

        if ($books->isEmpty()) {
            return response()->json(['message' => 'No books found for this author.'], 404);
        }

        return response()->json($books, 200);
    }
}
