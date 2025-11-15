<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    // Atribut yang boleh diisi massal
    protected $fillable = ['title','slug','excerpt','description','icon','image_path','features','is_published'];

    // Cast untuk JSON
    protected $casts = [
        'features' => 'array',
    ];
}
