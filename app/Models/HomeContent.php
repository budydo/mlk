<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * HomeContent — Model untuk menyimpan konten hero slider pada halaman beranda.
 */
class HomeContent extends Model
{
    use HasFactory;

    /**
     * Atribut yang dapat diisi secara massal.
     */
    protected $fillable = [
        'order',
        'title',
        'description',
        'image_path',
        'button_text',
        'button_url',
        'is_published',
    ];

    /**
     * Cast atribut ke tipe yang sesuai.
     */
    protected $casts = [
        'is_published' => 'boolean',
    ];

    /**
     * Scope untuk mengambil konten yang dipublikasikan dan diurutkan.
     */
    public function scopePublished($query)
    {
        return $query->where('is_published', true)->orderBy('order', 'asc');
    }
}
