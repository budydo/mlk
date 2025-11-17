<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\ContactMessage;

/**
 * Mailable untuk mengirim balasan ke pengirim kontak.
 */
class ReplyContactMessage extends Mailable
{
    use Queueable, SerializesModels;

    /** @var ContactMessage */
    public $contact;

    /** @var string */
    public $replyText;

    /**
     * Buat instance baru dari mailable.
     *
     * @param ContactMessage $contact pesan asal
     * @param string $replyText isi balasan dari admin/editor
     */
    public function __construct(ContactMessage $contact, string $replyText)
    {
        $this->contact = $contact;
        $this->replyText = $replyText;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        // Gunakan view sederhana (inline) untuk email balasan
        // Ensure semua values adalah string untuk Blade engine
        return $this->subject('Balasan dari ' . config('app.name'))
                    ->html(view('emails.reply-contact', [
                        'name' => $this->contact->name ?? '',
                        'message' => $this->contact->message ?? '',
                        'reply' => $this->replyText ?? '',
                    ])->render());
    }
}
