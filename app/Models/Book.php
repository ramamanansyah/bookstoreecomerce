<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'author',
        'price',
        'cover_image',
        'pdf_file',
        'rating',
        'review_count',
        'is_featured'
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'rating' => 'integer',
        'review_count' => 'integer',
        'is_featured' => 'boolean'
    ];
}