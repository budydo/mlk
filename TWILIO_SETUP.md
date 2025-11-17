# Panduan Setup Twilio WhatsApp Integration

## 🎯 Overview

Aplikasi ini menggunakan **Twilio** sebagai provider WhatsApp terpilih karena:

-   ✅ Paling mudah setup (hanya perlu Account SID & Auth Token)
-   ✅ Gratis untuk sandbox testing
-   ✅ Reliable dan well-documented
-   ✅ Support production dengan top-up credit
-   ✅ Instant activation (tidak perlu approval panjang)

---

## 📋 Prerequisites

-   Akun Twilio (sign up gratis di https://www.twilio.com/console)
-   WhatsApp Business Account (Twilio setup untuk Anda)
-   Nomor WhatsApp untuk testing atau production

---

## 🚀 Setup Langkah demi Langkah

### Step 1: Create Twilio Account

1. Buka https://www.twilio.com/console
2. Sign up dengan email
3. Verifikasi email Anda
4. Login ke Twilio Console

### Step 2: Dapatkan Account SID dan Auth Token

1. Di Twilio Console, cari **Account SID** dan **Auth Token** di dashboard
2. Copy kedua nilai tersebut (Auth Token tersembunyi, klik "Show")
3. Simpan di tempat aman

### Step 3: Setup WhatsApp Channel

#### Opsi A: Gunakan Twilio WhatsApp Sandbox (GRATIS & INSTAN)

1. Di Twilio Console, buka **Messaging → Try it Out → Send an SMS**
2. Pilih **WhatsApp** tab
3. Klik "Get Started"
4. Follow wizard untuk join sandbox
5. Akan mendapat nomor sandbox (biasanya `+1 415 XXX XXXX`)

**Kelebihan Sandbox:**

-   Gratis selamanya
-   Setup instant (< 5 menit)
-   Cocok untuk development & testing
-   Support grup dan media

**Keterbatasan:**

-   Hanya bisa kirim ke nomor yang sudah join sandbox
-   Nomor shared dengan pengguna lain
-   Message template terbatas

#### Opsi B: Setup WhatsApp Business (PRODUCTION)

1. Untuk production, Anda butuh WhatsApp Business Number
2. Process butuh approval WhatsApp & setup payment method
3. Lebih kompleks tapi unlimited recipients

### Step 4: Konfigurasi `.env`

Buka file `.env` dan isi:

```env
WHATSAPP_PROVIDER=twilio

TWILIO_ACCOUNT_SID=ACxxxxxxxxxxxxxxxxxxxxxxxxxx
TWILIO_AUTH_TOKEN=your_auth_token_here
TWILIO_WHATSAPP_FROM=+1415xxxxxxx
```

**Contoh:**

```env
WHATSAPP_PROVIDER=twilio

TWILIO_ACCOUNT_SID=AC4c5e12345678901234567890abcdef0
TWILIO_AUTH_TOKEN=a1b2c3d4e5f6g7h8i9j0k1l2m3n4o5p6
TWILIO_WHATSAPP_FROM=+14155552368
```

---

## 🧪 Testing

### Method 1: Gunakan Script Testing

```bash
php scripts/test_whatsapp_send.php
```

Script ini akan:

1. Validasi konfigurasi Twilio
2. Membuat contact message test
3. Mengirim WhatsApp message
4. Menampilkan response dari Twilio API

**Output Expected:**

```
✅ REPLY CREATED:
  ID: 1
  Email Status: sent
  WhatsApp Status: sent
  API Response:
    {"messages":[{"account_sid":"...", "sid":"SM..."}]}

🎉 SUCCESS! WhatsApp message sent to 085657104071
```

### Method 2: Via Admin Dashboard

1. Login ke aplikasi sebagai admin
2. Buka Menu **Contact Messages**
3. Klik salah satu pesan atau buat baru
4. Isi reply message
5. Klik **"📤 Kirim Balasan"**
6. Check status di halaman detail

---

## 🔍 Troubleshooting

### Error: "Twilio config missing"

**Penyebab:** TWILIO_ACCOUNT_SID, TWILIO_AUTH_TOKEN, atau TWILIO_WHATSAPP_FROM tidak di-set di `.env`

**Solusi:**

1. Edit `.env` dan pastikan ketiga variabel terisi
2. Restart Laravel application
3. Cek di Twilio Console untuk nilai yang benar

### Error: "Authentication failed" / "Invalid credentials"

**Penyebab:** Account SID atau Auth Token salah/expired

**Solusi:**

1. Buka Twilio Console
2. Copy ulang Account SID dan Auth Token yang paling fresh
3. Update `.env`
4. Cek tidak ada typo (copy-paste dengan teliti)

### Nomor tidak bisa terima message (Sandbox)

**Penyebab:** Nomor belum join sandbox atau sudah keluar

**Solusi:**

1. Buka Twilio Console → Messaging → WhatsApp
2. Lihat sandbox participants
3. Pastikan nomor target sudah join
4. Request ulang sandbox invite jika perlu

### API Response: "Invalid To number"

**Penyebab:** Nomor WhatsApp tidak valid atau format salah

**Solusi:**

1. Ensure nomor punya prefix negara (format internasional)
2. Contoh Indonesia: `628123456789` atau `+628123456789`
3. Aplikasi otomatis normalize nomor (0 → 62, dll), tapi double-check

---

## 📊 Monitoring

### Check Message Status

1. Di Laravel, database `contact_message_replies` akan ada record:

    - `email_status` - Status email (sent/failed/pending)
    - `whatsapp_status` - Status WhatsApp (sent/failed/queued/skipped)
    - `api_response` - Full response dari Twilio API

2. Di Twilio Console → Logs → Messages, bisa lihat semua message history

### Check Outbox (Fallback Queue)

Jika kirim gagal, message akan disimpan di `whatsapp_outboxes` table untuk retry manual:

```php
$pending = WhatsappOutbox::where('status', 'pending')->get();
```

---

## 💡 Tips & Best Practices

1. **Use .env.example** - Jangan push credentials ke git

    ```bash
    cp .env .env.example
    # Remove sensitive values dari .env.example
    git ignore .env
    ```

2. **Rate Limiting** - Twilio punya rate limits, jangan spam

    - Sandbox: 100 message/hari
    - Production: Tergantung plan

3. **Message Format** - WhatsApp support:

    - Text biasa
    - Emoji
    - Link (akan auto-clickable)
    - Line breaks (\n)

4. **Testing Number** - Gunakan nomor real untuk testing:
    - Nomor yang sudah Anda punya
    - Test dengan berbagai format nomor
    - Verify bahwa sandbox sudah accept nomor

---

## 🔗 Useful Links

-   Twilio Console: https://www.twilio.com/console
-   Twilio WhatsApp Docs: https://www.twilio.com/docs/whatsapp
-   WhatsApp API Integration: https://www.twilio.com/docs/whatsapp/send-messages
-   Pricing: https://www.twilio.com/whatsapp/pricing

---

## ❓ FAQ

**Q: Apakah gratis?**
A: WhatsApp Sandbox gratis selamanya. Production butuh top-up credit (bayar per message).

**Q: Berapa lama approve nomor?**
A: Sandbox instant (< 5 min). Production: 24-48 jam.

**Q: Bisa kirim ke nomor mana saja?**
A: Sandbox hanya ke nomor yang sudah join. Production unlimited.

**Q: Bagaimana dengan privacy?**
A: Twilio mengenkripsi data. Tidak simpan message content. Cek privacy policy di twilio.com
