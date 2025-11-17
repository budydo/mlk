<?php

namespace App\Services;

use App\Models\ContactMessage;
use App\Models\WhatsappOutbox;
use App\Mail\ReplyContactMessage;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

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
     * Kirim balasan ke contact message melalui email dan WhatsApp.
     * 
     * Proses:
     * 1. Kirim email ke alamat pengirim
     * 2. Kirim WhatsApp ke nomor telepon pengirim (jika ada)
     * 3. Simpan record reply di tabel contact_message_replies untuk tracking
     * 4. Jika WhatsApp API tidak dikonfigurasi, simpan ke whatsapp_outboxes
     *
     * @param ContactMessage $contact
     * @param string $replyText Text balasan
     * @param \App\Models\User|null $user User yang mengirim (optional, untuk audit trail)
     * @return \App\Models\ContactMessageReply
     */
    public function sendReply(ContactMessage $contact, string $replyText, $user = null)
    {
        // 1) Kirim email menggunakan Mailable
        $emailStatus = 'pending';
        try {
            Mail::to($contact->email)->send(new ReplyContactMessage($contact, $replyText));
            $emailStatus = 'sent';
        } catch (\Throwable $e) {
            // Jika gagal, catat error message
            $emailStatus = 'failed: ' . $e->getMessage();
        }

        // 2) Kirim WhatsApp via API jika dikonfigurasi.
        //    Sistem mendukung beberapa provider dengan pilihan via env WHATSAPP_PROVIDER:
        //    - 'meta'  => WhatsApp Cloud API (Meta / Facebook Graph API)
        //    - 'twilio' => Twilio WhatsApp API
        //    - 'generic' => panggil WHATSAPP_API_URL dengan payload { phone, message }
        $waProvider = env('WHATSAPP_PROVIDER', 'generic');
        $waResponse = null;
        $waStatus = 'pending';

        // Hanya coba kirim jika ada nomor telepon
        if (!empty($contact->phone)) {
            // Normalisasi nomor: hapus non-digit, ubah awalan 0 -> 62 (Indonesia),
            // jika mulai dengan 8 (tanpa 0) tambahkan 62.
            $rawPhone = (string) $contact->phone;
            $phoneDigits = preg_replace('/\D+/', '', $rawPhone);
            if ($phoneDigits === '') {
                $phone = '';
            } else {
                if (substr($phoneDigits, 0, 1) === '0') {
                    $phone = '62' . substr($phoneDigits, 1);
                } elseif (substr($phoneDigits, 0, 1) === '8') {
                    $phone = '62' . $phoneDigits;
                } else {
                    $phone = $phoneDigits;
                }
            }
            if (empty($phone)) {
                $waStatus = 'skipped';
                $waResponse = ['reason' => 'Phone number empty after normalization'];
                Log::warning('WhatsApp send skipped: phone empty after normalization', ['raw' => $rawPhone, 'contact_id' => $contact->id]);
            }
            try {
                if ($waProvider === 'meta') {
                    // WhatsApp Cloud API (Meta)
                    // Butuh: WHATSAPP_API_TOKEN (Bearer token) dan WHATSAPP_PHONE_NUMBER_ID
                    $token = env('WHATSAPP_API_TOKEN');
                    $phoneNumberId = env('WHATSAPP_PHONE_NUMBER_ID');

                    if (empty($token) || empty($phoneNumberId)) {
                        // Jika tidak lengkap, fallback ke outbox
                        throw new \RuntimeException('Meta WhatsApp config missing (WHATSAPP_API_TOKEN or WHATSAPP_PHONE_NUMBER_ID)');
                    }

                    // Endpoint resmi: https://graph.facebook.com/v17.0/{phone-number-id}/messages
                    $endpoint = sprintf('https://graph.facebook.com/v17.0/%s/messages', $phoneNumberId);

                    // Sesuaikan payload sesuai dokumentasi Meta WhatsApp Cloud API
                    $payload = [
                        'messaging_product' => 'whatsapp',
                        'to' => $phone, // gunakan format internasional tanpa + (contoh: 628123...)
                        'type' => 'text',
                        'text' => [
                            'preview_url' => false,
                            'body' => $replyText,
                        ],
                    ];

                    $request = Http::withToken($token)
                                ->withHeaders(['Accept' => 'application/json']);
                    
                    // Untuk development, selalu disable SSL verification di local environment
                    if (env('APP_ENV') === 'local') {
                        $request = $request->withoutVerifying();
                    }
                    
                    $resp = $request->post($endpoint, $payload);

                    $waResponse = ['status' => $resp->status(), 'body' => $resp->json()];
                    Log::info('WhatsApp (meta) response', ['status' => $resp->status(), 'body' => $resp->body()]);
                    $waStatus = $resp->successful() ? 'sent' : 'failed';

                } elseif ($waProvider === 'twilio') {
                    // Twilio API untuk WhatsApp
                    // Butuh: TWILIO_ACCOUNT_SID, TWILIO_AUTH_TOKEN, TWILIO_WHATSAPP_FROM
                    $sid = env('TWILIO_ACCOUNT_SID');
                    $token = env('TWILIO_AUTH_TOKEN');
                    $from = env('TWILIO_WHATSAPP_FROM');

                    if (empty($sid) || empty($token) || empty($from)) {
                        throw new \RuntimeException('Twilio config missing (TWILIO_ACCOUNT_SID/TWILIO_AUTH_TOKEN/TWILIO_WHATSAPP_FROM)');
                    }

                    // Twilio expects form-encoded params and 'whatsapp:' prefix for numbers
                    $twilioEndpoint = sprintf('https://api.twilio.com/2010-04-01/Accounts/%s/Messages.json', $sid);

                    $form = [
                        'From' => 'whatsapp:' . $from,
                        'To' => 'whatsapp:' . $phone,
                        'Body' => $replyText,
                    ];

                    $request = Http::withBasicAuth($sid, $token)->asForm();
                    
                    // Untuk development, selalu disable SSL verification jika di local environment
                    // atau jika IGNORE_SSL_ERRORS=true
                    $shouldDisableSSL = env('APP_ENV') === 'local' || env('IGNORE_SSL_ERRORS') == 'true' || env('IGNORE_SSL_ERRORS') == 'false';
                    
                    // Force disable SSL untuk development
                    if (env('APP_ENV') === 'local') {
                        $request = $request->withoutVerifying();
                        Log::debug('SSL verification disabled for Twilio (local environment)');
                    }
                    
                    $resp = $request->post($twilioEndpoint, $form);

                    $waResponse = ['status' => $resp->status(), 'body' => $resp->json()];
                    Log::info('WhatsApp (twilio) response', ['status' => $resp->status(), 'body' => $resp->body()]);
                    $waStatus = $resp->successful() ? 'sent' : 'failed';

                } else {
                    // Generic provider: panggil WHATSAPP_API_URL dengan payload { phone, message }
                    $waUrl = env('WHATSAPP_API_URL');
                    $waToken = env('WHATSAPP_API_TOKEN');

                    if (empty($waUrl)) {
                        throw new \RuntimeException('WHATSAPP_API_URL not configured');
                    }

                    $payload = [
                        'phone' => $phone,
                        'message' => $replyText,
                    ];

                    $request = Http::withBody(json_encode($payload), 'application/json')
                                   ->withHeaders(['Accept' => 'application/json']);

                    if (!empty($waToken)) {
                        $request = $request->withToken($waToken);
                    }
                    
                    // Untuk development, selalu disable SSL verification di local environment
                    if (env('APP_ENV') === 'local') {
                        $request = $request->withoutVerifying();
                    }

                    $resp = $request->post($waUrl);
                    $waResponse = ['status' => $resp->status(), 'body' => $resp->json()];
                    Log::info('WhatsApp (generic) response', ['status' => $resp->status(), 'body' => $resp->body()]);
                    $waStatus = $resp->successful() ? 'sent' : 'failed';
                }
            } catch (\Throwable $e) {
                // Jika terjadi error saat mengirim via provider, simpan ke outbox sebagai fallback
                $waStatus = 'failed';
                $waResponse = ['error' => $e->getMessage()];
                Log::error('WhatsApp provider error', ['error' => $e->getMessage(), 'contact_id' => $contact->id]);

                try {
                    $outbox = WhatsappOutbox::create([
                        'phone' => $phone ?: $contact->phone,
                        'message' => $replyText,
                        'status' => 'pending',
                    ]);
                    // Tambahkan informasi saved_id untuk referensi
                    $waResponse['saved_id'] = $outbox->id;
                    $waStatus = 'queued';
                } catch (\Throwable $inner) {
                    // Jika outbox juga gagal, catat error di response
                    $waResponse['outbox_error'] = $inner->getMessage();
                }
            }
        } else {
            // Tidak ada nomor telepon, skip WA
            $waStatus = 'skipped';
            $waResponse = ['reason' => 'No phone number provided'];
        }

        // 3) Simpan record balasan ke tabel contact_message_replies untuk tracking dan audit
        $reply = \App\Models\ContactMessageReply::create([
            'contact_message_id' => $contact->id,
            'user_id' => $user?->id,
            'reply_text' => $replyText,
            'email_status' => $emailStatus,
            'whatsapp_status' => $waStatus,
            'api_response' => $waResponse,
        ]);

        return $reply;
    }
}
