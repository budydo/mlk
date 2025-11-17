<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Model ContactMessageReply
 * 
 * Mewakili balasan yang dikirim admin/editor ke pesan kontak.
 * 
 * Relasi:
 * - Belongs to ContactMessage (banyak replies untuk satu pesan kontak)
 * - Belongs to User (admin/editor yang mengirim)
 */
class ContactMessageReply extends Model
{
    // Nama tabel (default: contact_message_replies)
    protected $table = 'contact_message_replies';

    // Kolom yang bisa diisi via mass assignment
    protected $fillable = [
        'contact_message_id',
        'user_id',
        'reply_text',
        'email_status',
        'whatsapp_status',
        'api_response',
    ];

    // Casting untuk api_response (simpan/ambil sebagai JSON)
    protected $casts = [
        'api_response' => 'json',
    ];

    /**
     * Relasi: Balasan ini milik satu pesan kontak
     */
    public function contactMessage()
    {
        return $this->belongsTo(ContactMessage::class);
    }

    /**
     * Relasi: Balasan ini dikirim oleh satu user (admin/editor)
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
