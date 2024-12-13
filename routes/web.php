<?php

use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\RatingController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Books routes
Route::get('/books', [BookController::class, 'index'])->name('books.index');

// Authors routes
Route::get('/top-authors', [AuthorController::class, 'top'])->name('author.top');

// Ratings routes
Route::get('/rate', [RatingController::class, 'create'])->name('rate.create');
Route::post('/rate', [RatingController::class, 'store'])->name('rate.store');
Route::get('/getBooks/{author}', [RatingController::class, 'getBooks'])->name('author.getBooks');
