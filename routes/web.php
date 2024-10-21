<?php

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BookListingController;
use App\Http\Controllers\MyBooksController;
use App\Models\BookListing;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

Route::middleware('auth')->group(function() {
    
    Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('verified')->name('dashboard');

    Route::get('/mybooks', [MyBooksController::class, 'book'])->middleware('verified')->name('mybooks');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'updateInfo'])->name('profile.info');

    Route::put('/profile', [ProfileController::class, 'updatePassword'])->name('profile.password');

    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::post('/borrow/book', [MyBooksController::class, 'borrowBook'])->name('borrow.book');

    Route::delete('/borrowed-books/{id}', [MyBooksController::class, 'removeBorrowedBook'])->name('borrowedBooks.remove');

});

Route::get('/', [BookListingController::class, 'index'])->name('home');

require __DIR__.'/auth.php';