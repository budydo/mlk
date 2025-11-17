# 📱 Dokumentasi WhatsApp Integration

## Ringkasan

Sistem ini memungkinkan admin mengirim balasan pesan kontak melalui **email** dan **WhatsApp** secara bersamaan ke nomor telepon pengirim pesan.

## Fitur

✅ **Kirim balasan via Email** - Menggunakan Laravel Mail dengan Mailable  
✅ **Kirim balasan via WhatsApp** - Integrasi dengan WhatsApp API eksternal  
✅ **Tracking Otomatis** - Semua balasan disimpan di DB (`contact_message_replies`)  
✅ **Fallback Outbox** - Jika API tidak dikonfigurasi, pesan disimpan di `whatsapp_outboxes`  
✅ **Riwayat Komunikasi** - Admin bisa melihat semua balasan yang sudah dikirim

---

## Alur Kerja

### 1. Admin Menerima Pesan Kontak

-   Pengunjung mengisi form kontak di `/kontak`
-   Pesan disimpan di tabel `contact_messages` dengan kolom:
    -   `name` - Nama pengirim
    -   `email` - Email pengirim
    -   `phone` - Nomor WhatsApp pengirim
    -   `message` - Isi pesan
    -   `subject` - Subject pesan
    -   `is_handled` - Flag sudah ditangani atau belum

### 2. Admin Membuka Halaman Pesan

-   Admin login ke `/admin`
-   Buka menu `Contact Messages` → `/admin/contact-messages`
-   Lihat daftar pesan, klik "Lihat" untuk detail pesan

### 3. Admin Mengirim Balasan

-   Di halaman detail pesan (`/admin/contact-messages/{id}`):
    -   Lihat detail pesan asli
    -   Lihat riwayat balasan yang sudah dikirim
    -   Tulis balasan di textarea
    -   Klik "📤 Kirim Balasan"

### 4. Sistem Mengirim Balasan

**MessageReplyService** akan:

1. ✉️ Kirim **Email** ke pengirim menggunakan Laravel Mail
2. 📱 Kirim **WhatsApp** ke nomor pengirim:
    - Jika `WHATSAPP_API_URL` dikonfigurasi → POST ke API eksternal
    - Jika tidak dikonfigurasi → Simpan ke tabel `whatsapp_outboxes` (manual send nanti)
3. 💾 Simpan record balasan ke tabel `contact_message_replies` untuk tracking
4. 🚩 Update flag `is_handled = true` pada pesan asli

---

## Konfigurasi

### Email (Laravel Mail)

Pastikan MAIL\_\* variables di `.env`:

```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your-email@gmail.com
MAIL_PASSWORD=your-app-password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=your-email@gmail.com
MAIL_FROM_NAME="MLK App"
```

### WhatsApp API (Optional)

Jika ingin mengirim langsung ke WhatsApp, setup di `.env`:

```env
WHATSAPP_PROVIDER=meta # atau 'twilio' atau 'generic'

## Opsi (Meta - WhatsApp Cloud API)
# WHATSAPP_API_TOKEN: Bearer token / access token dari Meta
# WHATSAPP_PHONE_NUMBER_ID: Phone Number ID dari WhatsApp Cloud
WHATSAPP_API_TOKEN=your_meta_access_token
WHATSAPP_PHONE_NUMBER_ID=your_phone_number_id

## Opsi (Twilio)
# TWILIO_ACCOUNT_SID, TWILIO_AUTH_TOKEN, TWILIO_WHATSAPP_FROM
TWILIO_ACCOUNT_SID=ACxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
TWILIO_AUTH_TOKEN=your_auth_token
TWILIO_WHATSAPP_FROM=62812xxxxxxx

## Opsi (Generic)
WHATSAPP_API_URL=https://api.whatsapp-service.com/send
WHATSAPP_API_TOKEN=your_token_here
```

**Rekomendasi WhatsApp API Services:**

-   **Twilio** (https://www.twilio.com) - Populer, reliable
-   **WhatsApp Cloud API** (https://developers.facebook.com/docs/whatsapp) - Official dari Meta
-   **Notchpay** (https://notchpay.co) - Lokal, affordable
-   **Fonnte** (https://fonnte.com) - Lokal, simple

Setiap service punya format request yang berbeda-beda. Anda mungkin perlu menyesuaikan payload di `app/Services/MessageReplyService.php` sesuai dokumentasi API service Anda.

### Contoh Payload dan Tes Manual

- Untuk **WhatsApp Cloud API (Meta)** gunakan cURL berikut (ganti PHONE_NUMBER_ID dan TOKEN):

```bash
curl -X POST "https://graph.facebook.com/v17.0/PHONE_NUMBER_ID/messages" \
    -H "Authorization: Bearer YOUR_META_TOKEN" \
    -H "Content-Type: application/json" \
    -d '{
        "messaging_product": "whatsapp",
        "to": "6285657104071",
        "type": "text",
        "text": { "body": "Halo dari MLK App - test message" }
    }'
```

- Untuk **Twilio** (ganti ACCOUNT_SID, AUTH_TOKEN, FROM):

```bash
curl -X POST "https://api.twilio.com/2010-04-01/Accounts/ACCOUNT_SID/Messages.json" \
    -u 'ACCOUNT_SID:AUTH_TOKEN' \
    --data-urlencode 'From=whatsapp:+TWILIO_WHATSAPP_FROM' \
    --data-urlencode 'To=whatsapp:+6285657104071' \
    --data-urlencode 'Body=Halo dari MLK App - test message'
```

Jika cURL sukses, response akan mengembalikan JSON dengan id pesan dan status. Jika gagal, periksa `api_response` di tabel `contact_message_replies` atau `whatsapp_outboxes`.

---

## File-File Penting

### Controllers

-   **`app/Http/Controllers/Admin/ContactMessageController.php`**
    -   `index()` - Daftar pesan
    -   `show()` - Detail pesan + form balas
    -   `reply()` - Proses kirim balasan
    -   `destroy()` - Hapus pesan

### Models

-   **`app/Models/ContactMessage.php`**
    -   Relasi `replies()` → `ContactMessageReply`
-   **`app/Models/ContactMessageReply.php`** (NEW)

    -   Menyimpan semua balasan yang dikirim
    -   Relasi `contactMessage()` dan `user()`

-   **`app/Models/WhatsappOutbox.php`**
    -   Fallback untuk WhatsApp yang gagal/pending

### Services

-   **`app/Services/MessageReplyService.php`**
    -   Method `sendReply($contact, $replyText, $user)`
    -   Orchestrate email + WhatsApp sending

### Mailable

-   **`app/Mail/ReplyContactMessage.php`**
    -   Format email untuk balasan

### Views

-   **`resources/views/admin/contact-messages/index.blade.php`**
    -   Daftar pesan dengan status
-   **`resources/views/admin/contact-messages/show.blade.php`** (IMPROVED)
    -   Detail pesan + riwayat balasan + form balas
-   **`resources/views/emails/reply-contact.blade.php`**
    -   Template email balasan

### Migrations

-   **`2025_11_16_000100_create_whatsapp_outboxes_table.php`** ✅
    -   Tabel untuk outbox WhatsApp
-   **`2025_11_16_000200_create_contact_message_replies_table.php`** ✅ (NEW)
    -   Tabel untuk tracking balasan (email & WA status)

---

## Testing

### 1. Test Email Sending

```bash
php artisan tinker
```

```php
$contact = App\Models\ContactMessage::first();
$service = app(App\Services\MessageReplyService::class);
$reply = $service->sendReply($contact, 'Terima kasih atas pesan Anda!', auth()->user());
dd($reply);
```

### 2. Test Interface

1. Login ke `/admin` dengan user `admin` (role: admin)
2. Buka `/admin/contact-messages`
3. Klik "Lihat" pada salah satu pesan
4. Tulis balasan dan klik "Kirim Balasan"
5. Cek:
    - Email masuk di inbox pengirim
    - Status berhasil di halaman
    - Record disimpan di tabel `contact_message_replies`

### 3. Check WhatsApp Status

Jika WhatsApp API tidak dikonfigurasi, cek outbox:

```bash
php artisan tinker
```

```php
// Lihat pesan yang masih pending di outbox
App\Models\WhatsappOutbox::where('status', 'pending')->get();
```

---

## Database Schema

### Tabel: contact_message_replies

```sql
CREATE TABLE contact_message_replies (
    id BIGINT PRIMARY KEY,
    contact_message_id BIGINT (FK -> contact_messages.id, CASCADE),
    user_id BIGINT (FK -> users.id, nullable),
    reply_text LONGTEXT,
    email_status VARCHAR (sent/failed/pending),
    whatsapp_status VARCHAR (sent/failed/queued/skipped/pending),
    api_response JSON (response dari API),
    created_at TIMESTAMP,
    updated_at TIMESTAMP
);
```

### Tabel: contact_messages (Updated)

```sql
-- Kolom yang sudah ada + relasi dengan replies
ALTER TABLE contact_messages ADD CONSTRAINT fk_replies
  FOREIGN KEY (id) REFERENCES contact_message_replies(contact_message_id) ON DELETE CASCADE;
```

---

## Troubleshooting

### ❌ Email Tidak Terkirim

-   Cek konfigurasi MAIL\_\* di `.env`
-   Cek logs: `storage/logs/laravel.log`
-   Test manual: `php artisan tinker` → `Mail::to('test@example.com')->send(new ReplyContactMessage(...))`

### ❌ WhatsApp Tidak Terkirim

-   Jika `WHATSAPP_API_URL` kosong → pesan akan ke outbox (normal)
-   Jika dikonfigurasi tapi gagal:
    -   Cek status di halaman detail pesan → "whatsapp: failed"
    -   Cek `api_response` JSON untuk error detail
    -   Validasi format nomor telepon (harus format internasional: 6281234567890)
    -   Cek dokumentasi API service Anda

### ❌ Nomor Telepon Invalid

-   Sistem otomatis skip WhatsApp jika nomor kosong
-   Pastikan pengirim mengisi field telepon di form kontak

### ❌ Halaman Blank/Error

-   Jika migration belum jalan: `php artisan migrate`
-   Clear cache: `php artisan cache:clear`
-   Cek logs: `storage/logs/laravel.log`

---

## Routes

```
GET  /admin/contact-messages              → ContactMessageController@index
GET  /admin/contact-messages/{id}         → ContactMessageController@show
POST /admin/contact-messages/{id}/reply   → ContactMessageController@reply
DELETE /admin/contact-messages/{id}       → ContactMessageController@destroy
```

---

## Selesai! 🎉

Sistem balasan WhatsApp + Email sudah siap. Setiap balasan dari admin akan:

1. ✉️ Dikirim ke **email** pengirim
2. 📱 Dikirim ke **WhatsApp** nomor pengirim (jika dikonfigurasi)
3. 💾 Disimpan di database untuk **tracking & audit trail**
