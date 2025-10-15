<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
        'excerpt',
        'status',
        'featured_image',
        'author_id'
    ];

    protected $casts = [
        'status' => 'string'
    ];

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }
    
    // Method untuk mendapatkan URL gambar featured
    public function getFeaturedImageUrl()
    {
        if ($this->featured_image) {
            return asset('storage/' . $this->featured_image);
        }
        return asset('images/default-blog-image.jpg'); // Gambar default
    }
}