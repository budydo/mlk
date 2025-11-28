# Fix WhatsApp Reply Messages Not Being Received

## Apa yang Sudah Diperbaiki

### ✅ 1. Email Template Error (FIXED)

**Masalah**: Error `htmlspecialchars(): Argument #1 ($string) must be of type string`
**Penyebab**: Cara passing data ke view yang salah
**Fix**: Ubah dari `.with()` method ke parameter langsung di `view()`
**File**: `app/Mail/ReplyContactMessage.php`

### ✅ 2. SSL Certificate Error for Windows Development (FIXED)

**Masalah**: `cURL error 60: SSL certificate problem: unable to get local issuer certificate`
**Penyebab**: Windows development environment tidak bisa verify SSL
**Fix**:

-   Tambah `IGNORE_SSL_ERRORS=true` di `.env`
-   Update MessageReplyService untuk `withoutVerifying()` di development
    **File**: `app/Services/MessageReplyService.php`, `.env`

## ⚠️ CRITICAL: Update Twilio Credentials

### Problem: Invalid Twilio Credentials

Credentials Anda saat ini adalah **PLACEHOLDER/TEST VALUES** dan TIDAK BISA mengirim pesan sebenarnya!

```env
# Nilai sensitif telah dihapus dari repo
TWILIO_ACCOUNT_SID=REDACTED_TWILIO_ACCOUNT_SID
TWILIO_AUTH_TOKEN=REDACTED_TWILIO_AUTH_TOKEN
TWILIO_WHATSAPP_FROM=
```

### Solution: Get Real Credentials from Twilio

**Buka file**: `TWILIO_CREDENTIALS_SETUP.md` untuk step-by-step instruksi.

Ringkas:

1. https://www.twilio.com/ → Sign up free
2. Verify nomor telepon Anda
3. Go to https://console.twilio.com/
4. Copy real Account SID & Auth Token
5. Activate WhatsApp Sandbox
6. Update credentials di `.env`

```env
# ✅ VALID FORMAT (replace dengan values Anda!)
TWILIO_ACCOUNT_SID=ACxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
TWILIO_AUTH_TOKEN=your_real_auth_token_here
TWILIO_WHATSAPP_FROM=+1234567890
```

## Testing Steps

### 1. Clear Cache

```bash
php artisan config:cache
php artisan cache:clear
```

### 2. Test dengan Script

```bash
php scripts/test_send_whatsapp.php
```

**Expected Output (SUCCESS)**:

```
Reply created. ID: X
Email status: sent
WhatsApp status: sent
API response: {...}
```

**Expected Output (QUEUED)**:

```
Reply created. ID: X
Email status: sent
WhatsApp status: queued
API response: {"saved_id": Y}
```

### 3. Send Reply dari Dashboard

1. Buka admin dashboard: http://mlk-app.test/admin
2. Menu "Pesan Kontak"
3. Pilih pesan yang ingin dibalas
4. Isi reply text
5. Klik "Kirim Balasan"
6. Check notification: "Balasan terkirim! Email: sent, WhatsApp: sent"

### 4. Check Logs

Database queries untuk verify:

```sql
-- Check reply record
SELECT * FROM contact_message_replies ORDER BY created_at DESC LIMIT 1;

-- Check outbox (jika status queued)
SELECT * FROM whatsapp_outboxes ORDER BY created_at DESC LIMIT 1;

-- Check logs
tail -f storage/logs/laravel.log
```

## Queue Processing (Optional)

Jika `QUEUE_CONNECTION=database`, messages mungkin dalam queue:

### Check Queue Status

```bash
php artisan queue:failed
```

### Process Queue Manually

```bash
php artisan queue:work --once
```

### Run Queue Worker (Background)

```bash
php artisan queue:work
```

Di Windows, gunakan:

```powershell
php artisan queue:work --queue=default
```

## Complete Checklist

-   [ ] Email template error FIXED (ReplyContactMessage.php)
-   [ ] SSL error FIXED (IGNORE_SSL_ERRORS=true di .env)
-   [ ] Twilio credentials UPDATED dengan values real
-   [ ] Config cache cleared (`php artisan config:cache`)
-   [ ] Test script berhasil (`php scripts/test_send_whatsapp.php`)
-   [ ] Dashboard test berhasil (kirim 1 reply)
-   [ ] Pesan masuk ke nomor WhatsApp

## Troubleshooting

### Pesan masih tidak terkirim

1. Check `php scripts/test_send_whatsapp.php` output
2. Check `storage/logs/laravel.log` untuk error details
3. Check database `contact_message_replies.api_response` untuk error message
4. Verify Twilio credentials di https://console.twilio.com/

### Email terkirim tapi WhatsApp tidak

1. Check nomor telepon format valid (harus ada digits)
2. Jika sandbox: pastikan nomor sudah join sandbox Twilio
3. Check Twilio console untuk incoming messages

### Email juga tidak terkirim

1. Check `MAIL_MAILER` setting di `.env`
2. Untuk development, gunakan `MAIL_MAILER=log`
3. Check `storage/logs/laravel.log` untuk error

## Files Modified

```
✅ app/Mail/ReplyContactMessage.php - Fixed view data passing
✅ app/Services/MessageReplyService.php - Added SSL bypass & better error handling
✅ .env - Added IGNORE_SSL_ERRORS setting
📄 TWILIO_CREDENTIALS_SETUP.md - New guide
📄 WHATSAPP_REPLY_FIX.md - This file
```

---

**Last Updated**: 2025-11-17
