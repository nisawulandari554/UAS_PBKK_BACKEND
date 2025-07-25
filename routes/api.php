<?php

use App\Models\Authors;
use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BooksController;
use App\Http\Controllers\LoansController;
use App\Http\Controllers\User1Controller;
use App\Http\Controllers\AuthorsController;
use App\Http\Controllers\BookAuthorsController;

Route::post('/login', [AuthController::class, 'login']);


Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::apiResource('user', UserController::class);
    
    Route::apiResource('authors', AuthorsController::class);
    Route::apiResource('book-authors', BookAuthorsController::class);
    Route::apiResource('books', BooksController::class);
    Route::apiResource('loans', LoansController::class);
    Route::apiResource('user1', User1Controller::class);

    Route::get('/dashboard-counts', function () {
        return response()->json([
            'total_users'     => \App\Models\User::count(),
            'total_pengguna'     => \App\Models\User1::count(),
            'total_penulis'     => \App\Models\Authors::count(),
            'total_buku'     => \App\Models\Books::count(),
            'total_loans'     => \App\Models\Loans::count(),
            'total_book_author'     => \App\Models\Book_Authors::count(),
            
        ]);
    });
});