# 🎬 Quick Start: WhatsApp Testing dengan Twilio

## ✅ Checklist Sebelum Testing

-   [ ] Sudah membuat akun Twilio (https://www.twilio.com/console)
-   [ ] Sudah copy Account SID dan Auth Token
-   [ ] Sudah setup WhatsApp Sandbox atau Production
-   [ ] Sudah tahu nomor WhatsApp Twilio yang di-assign
-   [ ] Database sudah di-setup (migrated)

---

## 📝 Langkah 1: Update .env dengan Credentials Anda

Edit file `.env` di root project:

```env
WHATSAPP_PROVIDER=twilio

TWILIO_ACCOUNT_SID=ACxxxxxxxxxxxxxxxxxxxxxxxxxx
TWILIO_AUTH_TOKEN=your_auth_token_here
TWILIO_WHATSAPP_FROM=+14155552368
```

**Dapatkan nilai ini dari:**

1. Buka https://www.twilio.com/console
2. Cari "Account SID" dan "Auth Token" di dashboard
3. Cari WhatsApp number yang di-assign (check di Messaging → WhatsApp)

---

## 🚀 Langkah 2: Jalankan Testing Script

Buka terminal di folder project, jalankan:

```bash
php scripts/test_whatsapp_send.php
```

**Script akan:**

1. ✅ Validasi konfigurasi Twilio
2. ✅ Membuat contact message baru dengan nomor 085657104071
3. ✅ Mengirim WhatsApp message via Twilio API
4. ✅ Menampilkan status pengiriman (sent/failed/queued)

---

## 📊 Expected Output

**Jika berhasil:**

```
======================================
WhatsApp Integration Testing (Twilio)
======================================

[1] Checking Twilio Configuration...
  Provider: twilio
  Account SID: AC**...****
  Auth Token: ****...****
  From Number: +14155552368
✅ Configuration looks good!

[2] Creating/Finding Contact Message...
  Created new contact message (ID: 1)
  Phone: 085657104071
  Email: test@example.com

[3] Finding Admin User...
  Admin: Admin User (admin@example.com)

[4] Sending WhatsApp Message...
  Target: 085657104071
  Message: Hello from MLK App! 🎉...

✅ REPLY CREATED:
  ID: 1
  Email Status: sent
  WhatsApp Status: sent
  API Response:
    {"messages":[{"account_sid":"ACxxxx", "sid":"SMxxxx"}]}

🎉 SUCCESS! WhatsApp message sent to 085657104071
```

**Jika gagal:**

```
❌ ERROR: Twilio config missing (TWILIO_ACCOUNT_SID/TWILIO_AUTH_TOKEN/TWILIO_WHATSAPP_FROM)

Please set:
   - TWILIO_ACCOUNT_SID
   - TWILIO_AUTH_TOKEN
   - TWILIO_WHATSAPP_FROM
```

---

## 🔧 Troubleshooting

| Issue                                       | Solusi                                                                          |
| ------------------------------------------- | ------------------------------------------------------------------------------- |
| `Authentication failed`                     | Periksa credentials di Twilio Console, pastikan tidak ada typo                  |
| `Invalid To number`                         | Ensure nomor target dengan prefix negara (628xx untuk Indo)                     |
| `Sandbox: Cannot send to number not joined` | Nomor target harus dulu join sandbox via Whatsapp message                       |
| `Message queued in outbox`                  | API berhasil di-reach tapi nomor tidak terdaftar, cek `whatsapp_outboxes` table |

---

## 📲 Setup Nomor untuk Testing

Sebelum bisa terima message, nomor WhatsApp harus:

1. **Untuk Sandbox Testing:**

    - Buka Twilio Console → Messaging → WhatsApp → Sandbox
    - Kirim message khusus ke nomor sandbox untuk "join"
    - Contoh: Kirim "join [code]" ke nomor Twilio sandbox
    - Setelah itu, nomor Anda bisa terima test message

2. **Untuk Production:**
    - Nomor sudah terdaftar di WhatsApp Business
    - Bisa langsung kirim ke nomor apapun

---

## 🎯 Next Steps

1. **Setup .env** dengan credentials Twilio Anda
2. **Join sandbox** jika pakai sandbox (lihat instruksi di Twilio Console)
3. **Run testing script**: `php scripts/test_whatsapp_send.php`
4. **Verify di aplikasi**: Login admin → Contact Messages → cek reply status
5. **Cek di database**: `contact_message_replies` table untuk lihat detail

---

## 💡 Tips

-   **Test multiple numbers** untuk ensure integration stable
-   **Check logs** di Twilio Console untuk debug detailed
-   **Monitor database** - semua message status tersimpan di `contact_message_replies`
-   **Fallback queue** - jika gagal, message auto-save di `whatsapp_outboxes` untuk retry

---

Sudah siap? 🚀 Jalankan: `php scripts/test_whatsapp_send.php`
