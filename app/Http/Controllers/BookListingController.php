<?php

namespace App\Http\Controllers;

use App\Models\BookListing;
use App\Http\Requests\StoreBookListingRequest;
use App\Http\Requests\UpdateBookListingRequest;
use Inertia\Inertia;
use App\Models\User;
use Illuminate\Pagination\Paginator;
use Illuminate\Http\Request;

class BookListingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        

        $bookListings = BookListing::with('user')
            ->filter(request(['search', 'user_id']))
            ->latest()
            ->paginate(6)
            ->withQueryString();

        return Inertia::render('Home', [
            'bookListings' => $bookListings,
            'searchTerm' => $request->search,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBookListingRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(BookListing $bookListing)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BookListing $bookListing)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBookListingRequest $request, BookListing $bookListing)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BookListing $bookListing)
    {
        //
    }
}
