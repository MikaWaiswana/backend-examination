<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AuthorController extends Controller
{
    public function top()
    {
        // Subquery untuk menghitung jumlah voters (ratings)
        $subQuery = DB::table('books')
            ->join('ratings', 'books.id', '=', 'ratings.book_id')
            ->select('books.author_id', DB::raw('COUNT(ratings.id) as voters'))
            ->groupBy('books.author_id');

        // Query utama untuk mengambil penulis dan jumlah voters
        $authors = Author::select('authors.*', DB::raw('IFNULL(voters.voters, 0) as voters'))
            ->leftJoinSub($subQuery, 'voters', 'authors.id', '=', 'voters.author_id')
            ->orderBy('voters', 'desc')
            ->limit(10)
            ->get();

        return view('authors.top', compact('authors'));
    }
}
