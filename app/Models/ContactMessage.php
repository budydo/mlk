<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Model ContactMessage
 * 
 * Mewakili pesan kontak yang dikirim dari form di halaman /kontak.
 * 
 * Relasi:
 * - HasMany replies (satu pesan kontak bisa punya banyak balasan dari admin/editor)
 */
class ContactMessage extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'email', 'phone', 'message', 'subject', 'source', 'is_handled'];

    /**
     * Relasi: Pesan kontak ini memiliki banyak balasan
     */
    public function replies()
    {
        return $this->hasMany(ContactMessageReply::class);
    }
}
