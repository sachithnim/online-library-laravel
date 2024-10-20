<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BorrowedBook extends Model
{
    use HasFactory;

    // Define the table name if it does not follow Laravel's naming convention
    protected $table = 'borrowed_books'; // Optional if the table name is 'borrowed_books'

    // Allow mass-assignment on these fields
    protected $fillable = ['user_id', 'book_listing_id'];

    // Define relationships to User and BookListing models
    public function user() {
        return $this->belongsTo(User::class);
    }

    public function bookListing() {
        return $this->belongsTo(BookListing::class);
    }

    // If you are not using timestamps, you can disable them like this
    public $timestamps = true; // Remove or set to 'false' if you don't use timestamps
}
