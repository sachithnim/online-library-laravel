<?php

namespace App\Http\Controllers;

use App\Models\BookListing;
use App\Models\BorrowedBook;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class MyBooksController extends Controller
{
    public function book()
    {
        
        $userId = Auth::id();

    // Fetch the borrowed books with the related book listings for the authenticated user
    $borrowedBooks = BorrowedBook::where('user_id', $userId)
                    ->with('bookListing') // Eager load the related book listings
                    ->get();

    // Pass the borrowed books data to the 'MyBooks' component via Inertia
    return Inertia::render('MyBooks', [
        'borrowedBooks' => $borrowedBooks,
    ]);
    }

    public function borrowBook(Request $request)
{
    // Validate the incoming request
    $request->validate([
        'book_listing_id' => 'required|exists:book_listings,id',
    ]);

    // Get the book listing by ID
    $bookListing = BookListing::findOrFail($request->book_listing_id);

    // Get the authenticated user's ID
    $authUserId = Auth::id(); // This will get the authenticated user's ID

    // Create a new borrowed book record
    $borrow = new BorrowedBook();
    $borrow->user_id = $authUserId; // Assign the authenticated user's ID to the user_id field
    $borrow->book_listing_id = $bookListing->id;
    $borrow->save();

    // Return success message or redirect
    return back()->with('success', 'You have successfully borrowed the book.');
}

}
