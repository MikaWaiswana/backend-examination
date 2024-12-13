<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;    
use Illuminate\Support\Facades\DB;

class BookController extends Controller
{
    public function index(Request $request)
    {
        $limit = $request->input('limit', 10);
        $search = $request->input('search', null);

        $books = Book::with('author', 'category')
            ->withCount([
                'ratings as average_rating' => function ($query) {
                    $query->select(DB::raw('COALESCE(AVG(rating), 0)')); // Calculate average rating.
                },
                'ratings as voters' => function ($query) {
                    $query->select(DB::raw('COUNT(*)')); // Count total voters.
                }
            ])
            ->when($search, function ($query, $search) {
                // Apply search filters.
                $query->where('title', 'like', '%' . $search . '%')
                      ->orWhereHas('author', function ($q) use ($search) {
                          $q->where('name', 'like', '%' . $search . '%'); // Search in author name.
                      })
                      ->orWhereHas('category', function ($q) use ($search) {
                          $q->where('category_name', 'like', '%' . $search . '%'); // Search in category name.
                      });
            })
            ->orderBy('average_rating', 'desc')
            ->limit($limit)
            ->get();

        return view('books.index', compact('books', 'limit'));
    }
}
