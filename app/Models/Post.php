<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Model Post — menyimpan artikel/blog.
 */
class Post extends Model
{
    use HasFactory;

    // Field yang dapat diisi massal
    protected $fillable = [
        'title',
        'slug',
        'excerpt',
        'content',
        'cover_image',
        'is_published',
        'published_at',
    ];

    // Cast tipe data
    protected $casts = [
        'is_published' => 'boolean',
        'published_at' => 'datetime',
    ];

    /**
     * Scope: hanya yang dipublikasikan
     */
    public function scopePublished($query)
    {
        return $query->where('is_published', 1)->whereNotNull('published_at')->where('published_at', '<=', now());
    }
}
