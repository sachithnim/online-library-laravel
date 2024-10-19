<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookListing extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'type',
        'price',
        'image',
        'approved',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function scopeFilter($query, array $filters)
    {
        if ($filters['search'] ?? false) {
            $query
                ->where('title', 'like', '%' . request('search') . '%')
                ->orWhere('description', 'like', '%' . request('search') . '%');
        }
    }
}
