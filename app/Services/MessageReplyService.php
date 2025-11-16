<?php

namespace App\Services;

use App\Models\ContactMessage;
use App\Models\WhatsappOutbox;
use App\Mail\ReplyContactMessage;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Http;

/**
 * Service untuk mengirim balasan (email + WhatsApp).
 *
 * Cara kerja:
 * - Mengirim email menggunakan Laravel Mail (mailable ReplyContactMessage)
 * - Mencoba mengirim WhatsApp via endpoint yang dikonfigurasikan di env:
 *   WHATSAPP_API_URL dan WHATSAPP_API_TOKEN
 * - Jika endpoint tidak dikonfigurasi atau gagal, simpan di tabel whatsapp_outboxes
 *   untuk pemeriksaan/manual resend.
 */
class MessageReplyService
{
    /**
     * Kirim balasan ke contact message.
     *
     * @param ContactMessage $contact
     * @param string $replyText
     * @return array status
     */
    public function sendReply(ContactMessage $contact, string $replyText): array
    {
        // 1) Kirim email menggunakan Mailable
        try {
            Mail::to($contact->email)->send(new ReplyContactMessage($contact, $replyText));
            $emailStatus = 'sent';
        } catch (\Throwable $e) {
            // Jika gagal, catat error
            $emailStatus = 'failed: ' . $e->getMessage();
        }

        // 2) Kirim WhatsApp via API jika dikonfigurasi
        $waUrl = env('WHATSAPP_API_URL');
        $waToken = env('WHATSAPP_API_TOKEN');
        $waResponse = null;
        $waStatus = 'pending';

        if ($waUrl) {
            try {
                $payload = [
                    'phone' => $contact->phone, // nomor penerima (format internasional diharapkan)
                    'message' => $replyText,
                ];

                $request = Http::withBody(json_encode($payload), 'application/json');

                if ($waToken) {
                    $request = $request->withToken($waToken);
                }

                $resp = $request->post($waUrl);

                $waResponse = [
                    'status' => $resp->status(),
                    'body' => $resp->body(),
                ];

                if ($resp->successful()) {
                    $waStatus = 'sent';
                } else {
                    $waStatus = 'failed';
                }
            } catch (\Throwable $e) {
                $waStatus = 'failed';
                $waResponse = ['error' => $e->getMessage()];
            }
        } else {
            // Simpan ke outbox agar bisa ditinjau dan dikirim manual
            $outbox = WhatsappOutbox::create([
                'phone' => $contact->phone,
                'message' => $replyText,
                'status' => 'pending',
            ]);
            $waResponse = ['saved_id' => $outbox->id];
            $waStatus = 'queued';
        }

        return [
            'email' => $emailStatus,
            'whatsapp' => $waStatus,
            'whatsapp_response' => $waResponse,
        ];
    }
}
