# Setup Twilio WhatsApp Credentials

## Problem

Pesan balasan Anda tidak sampai ke nomor WhatsApp karena credentials Twilio yang digunakan tidak valid.

Credentials saat ini di `.env` telah dihapus untuk keamanan:

```
# Nilai sensitif telah dihapus dan diganti placeholder
TWILIO_ACCOUNT_SID=REDACTED_TWILIO_ACCOUNT_SID
TWILIO_AUTH_TOKEN=REDACTED_TWILIO_AUTH_TOKEN
TWILIO_WHATSAPP_FROM=
```

❌ **Nilai sensitif telah dihapus dari repo — jika ingin menggunakan Twilio lagi, isi ulang kredensial baru di `.env`**

## Solusi: Dapatkan Credentials Real dari Twilio

### Langkah 1: Buat Account Twilio

1. Buka https://www.twilio.com/
2. Klik "Sign up for free"
3. Isi form dengan data Anda
4. Verifikasi email
5. Verifikasi nomor telepon

### Langkah 2: Setup WhatsApp Sandbox (Testing)

1. Login ke https://console.twilio.com/
2. Pilih menu "Messaging" → "Try it out" → "Send a WhatsApp message"
3. Di bagian "Twilio WhatsApp Sandbox":
    - Klik "Activate"
    - Ikuti instruksi untuk mengaktifkan sandbox WhatsApp
    - Kirim pesan ke nomor yang diberikan Twilio untuk join sandbox

### Langkah 3: Dapatkan Account SID & Auth Token

1. Di https://console.twilio.com/ dashboard
2. Cari bagian "Account Info"
3. Copy:
    - **Account SID**: Format `ACxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx` (lebih panjang)
    - **Auth Token**: String random panjang

### Langkah 4: Dapatkan Twilio WhatsApp Number

1. Dari "Send a WhatsApp message" page, cari nomor Twilio yang digunakan
2. Format biasanya: `+1XXX5238886` atau yang serupa
3. Ini adalah nilai untuk `TWILIO_WHATSAPP_FROM`

### Langkah 5: Update .env

```dotenv
TWILIO_ACCOUNT_SID=ACxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
TWILIO_AUTH_TOKEN=your_long_auth_token_here
TWILIO_WHATSAPP_FROM=+1234567890
```

## Testing Credentials

Setelah update `.env`, jalankan test script:

```bash
php scripts/test_send_whatsapp.php
```

Sukses jika output menunjukkan:

```
WhatsApp status: sent
```

## Catatan Penting

-   **Sandbox Mode**: Pesan hanya bisa dikirim ke nomor yang sudah terdaftar di sandbox
-   **Verifikasi Nomor**: Nomor penerima harus mengirim pesan join ke Twilio terlebih dahulu
-   **Production Mode**: Untuk mengirim ke semua nomor, upgrade ke production (butuh billing)
-   **Keep Secret**: Jangan share `TWILIO_AUTH_TOKEN` ke orang lain!

## Troubleshooting

### ❌ "cURL error 60: SSL certificate problem"

Sudah diperbaiki dengan `IGNORE_SSL_ERRORS=true` di development.
Di production, gunakan certified SSL/TLS.

### ❌ "Twilio config missing"

Pastikan semua 3 variabel ada di `.env`:

-   TWILIO_ACCOUNT_SID
-   TWILIO_AUTH_TOKEN
-   TWILIO_WHATSAPP_FROM

### ❌ "WhatsApp status: failed"

Cek di database tabel `contact_message_replies` kolom `api_response` untuk error detail.

## Reference

-   Twilio Console: https://console.twilio.com/
-   WhatsApp API Docs: https://www.twilio.com/docs/whatsapp/api
-   WhatsApp Sandbox: https://www.twilio.com/docs/whatsapp/sandbox
