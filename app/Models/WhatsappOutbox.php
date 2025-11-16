<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Model untuk menyimpan upaya pengiriman WhatsApp (outbox).
 */
class WhatsappOutbox extends Model
{
    // Atribut yang dapat diisi massal
    protected $fillable = ['phone','message','status','response'];
}
