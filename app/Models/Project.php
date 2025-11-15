<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Project — Model untuk menyimpan data proyek/portofolio perusahaan.
 */
class Project extends Model
{
    use HasFactory;

    /**
     * Atribut yang dapat diisi secara massal.
     */
    protected $fillable = [
        'title',
        'slug',
        'cover_image',
        'excerpt',
        'description',
        'is_published',
        'is_featured',
    ];

    /**
     * Cast atribut ke tipe yang sesuai.
     */
    protected $casts = [
        'is_published' => 'boolean',
        'is_featured' => 'boolean',
    ];

    /**
     * Scope untuk mengambil proyek unggulan yang dipublikasikan.
     */
    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true)->where('is_published', true);
    }

    /**
     * Scope untuk mengambil proyek yang dipublikasikan.
     */
    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }
}
