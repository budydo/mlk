# ✅ WHATSAPP INTEGRATION - FINAL CHECKLIST

**Target Testing:** Mengirim WhatsApp ke nomor **085657104071**  
**Provider:** **TWILIO** (easiest & best for beginners)  
**Status:** ✅ Ready to configure & test

---

## 📋 PRE-SETUP CHECKLIST

-   [ ] Sudah read `WHATSAPP_NEXT_STEPS.md`
-   [ ] Paham kalau Twilio adalah pilihan terbaik
-   [ ] Punya akses internet untuk setup Twilio
-   [ ] Punya email untuk daftar Twilio (opsional, bisa pakai akun existing)

---

## 🎬 FASE 1: TWILIO ACCOUNT SETUP (10 MINUTES)

### 1.1: Buat Account Twilio

```
☐ Kunjungi: https://www.twilio.com/console
☐ Click "Sign Up"
☐ Isi email, password, confirm password
☐ Pilih "Developers" → "Send messages with code"
☐ Verify email Anda
☐ Login ke Twilio Console
```

### 1.2: Dapatkan Account Credentials

```
☐ Di dashboard Twilio, cari kotak Account SID
  → Copy dan simpan tempat aman

☐ Di dashboard, cari Auth Token (hidden)
  → Click "Show"
  → Copy dan simpan

☐ Simpan ke notepad/password manager SEMENTARA
  (akan dipakai di step 2)
```

**Contoh:**

```
Account SID: AC4c5e12345678901234567890abcdef0
Auth Token: a1b2c3d4e5f6g7h8i9j0k1l2m3n4o5p6
```

---

## 🎯 FASE 2: SETUP WHATSAPP SANDBOX (5 MINUTES)

### 2.1: Setup Sandbox

```
☐ Di Twilio Console, buka:
  Messaging → Try it Out → Send an SMS

☐ Di atas form, lihat tabs: SMS, Voice, WhatsApp

☐ Click tab "WhatsApp"

☐ Click "Get Started" atau "View Sandbox"

☐ Follow instruksi untuk join sandbox
```

### 2.2: Get Sandbox Number

```
☐ Setelah join, akan dapat sandbox number
  Contoh: +1 415 523 8886

☐ Copy & simpan nomor ini
  (akan pakai di step 3)

☐ Pastikan nomor format: +xxxxxxxxxxx (dengan +)
```

---

## ⚙️ FASE 3: KONFIGURASI .ENV (3 MINUTES)

### 3.1: Edit File .env

```
☐ Buka file: c:\projects\mlk-app\.env

☐ Cari section "# ========== WhatsApp Configuration =========="

☐ Pastikan field ini ada:
  WHATSAPP_PROVIDER=twilio
  TWILIO_ACCOUNT_SID=
  TWILIO_AUTH_TOKEN=
  TWILIO_WHATSAPP_FROM=

☐ Jangan ubah hal lain di .env
```

### 3.2: Isi Credentials

```
☐ Untuk TWILIO_ACCOUNT_SID=
  → Copy dari Step 1.2 Account SID

☐ Untuk TWILIO_AUTH_TOKEN=
  → Copy dari Step 1.2 Auth Token

☐ Untuk TWILIO_WHATSAPP_FROM=
  → Copy dari Step 2.2 Sandbox Number
  → Pastikan dengan + prefix (contoh: +14155238886)
```

**Hasil akhir (contoh):**

```env
WHATSAPP_PROVIDER=twilio
TWILIO_ACCOUNT_SID=AC4c5e12345678901234567890abcdef0
TWILIO_AUTH_TOKEN=a1b2c3d4e5f6g7h8i9j0k1l2m3n4o5p6
TWILIO_WHATSAPP_FROM=+14155238886
```

### 3.3: Save & Verify

```
☐ Save file .env (Ctrl+S)

☐ Double-check tidak ada typo:
  ✓ Account SID mulai dengan "AC"
  ✓ Auth Token panjang (30+ chars)
  ✓ WhatsApp FROM dengan "+" prefix
  ✓ Tidak ada space di awal/akhir
```

---

## 🧪 FASE 4: TESTING (2 MINUTES)

### 4.1: Run Testing Script

```bash
# Buka Terminal/PowerShell di folder project
# Jalankan command ini:

php scripts/test_whatsapp_send.php
```

### 4.2: Expected Output

```
Jika BERHASIL, akan muncul:
✅ Configuration looks good!
✅ REPLY CREATED:
   ID: 1
   WhatsApp Status: sent
🎉 SUCCESS! WhatsApp message sent to 085657104071

Jika GAGAL, akan muncul error message
Baca "Troubleshooting" di bawah
```

### 4.3: Verifikasi di Database (Optional)

```bash
php artisan tinker
> ContactMessageReply::latest()->first()
```

Expected output:

```
=> App\Models\ContactMessageReply {#...
     id: 1,
     whatsapp_status: "sent",
     api_response: {"messages": [...]},
   }
```

---

## 🚀 FASE 5: BONUS - MANUAL TESTING (5 MINUTES)

Setelah script test berhasil, test via admin dashboard:

### 5.1: Login ke Aplikasi

```
☐ Buka: http://mlk-app.test (atau URL app Anda)

☐ Login sebagai Admin
```

### 5.2: Create Test Message

```
☐ Go to: Admin → Contact Messages

☐ Click "Create" atau gunakan existing message

☐ Isi form dengan:
   Name: Test User
   Email: test@example.com
   Phone: 085657104071
   Message: Test message

☐ Click Save
```

### 5.3: Send Reply

```
☐ Buka message yang baru dibuat

☐ Di section "Reply", tulis:
   "Hello from MLK App! This is a test message."

☐ Click "📤 Kirim Balasan"

☐ Tunggu processing (2-3 detik)

☐ Lihat status: "sent", "failed", atau "queued"
```

### 5.4: Check Database

```
☐ Buka database → contact_message_replies table

☐ Lihat record terbaru (dengan ID terbesar)

☐ Cek column:
   - email_status: "sent" atau "failed"
   - whatsapp_status: "sent" atau "failed"
   - api_response: Berisi response dari Twilio
```

---

## 🆘 TROUBLESHOOTING

### ❌ Error: "Configuration missing"

**Penyebab:**

-   TWILIO_ACCOUNT_SID, TWILIO_AUTH_TOKEN, atau TWILIO_WHATSAPP_FROM belum diisi

**Solusi:**

-   [ ] Buka `.env`
-   [ ] Pastikan ketiga field terisi (jangan kosong atau "xxx")
-   [ ] Pastikan tidak ada `#` di awal line (uncommented)
-   [ ] Save file
-   [ ] Run test script lagi

---

### ❌ Error: "Authentication failed"

**Penyebab:**

-   Account SID atau Auth Token salah/typo

**Solusi:**

-   [ ] Buka Twilio Console (https://www.twilio.com/console)
-   [ ] Copy **ULANG** Account SID & Auth Token (jangan dari note/screenshot)
-   [ ] Paste ke `.env` (replace value lama)
-   [ ] Pastikan tidak ada spasi di awal/akhir
-   [ ] Save & test lagi

---

### ❌ Error: "Invalid To number"

**Penyebab:**

-   Nomor target format salah

**Solusi:**

-   Script otomatis normalize nomor (0 → 62)
-   Jika masih error, cek format:
    ✓ Original: `085657104071`
    ✓ Normalized: `628567104071` ✓ atau `+628567104071` ✓

---

### ⚠️ Status: "Message queued in outbox"

**Penyebab:**

-   Nomor belum join sandbox, atau tidak registered

**Solusi (untuk sandbox):**

-   [ ] Buka Twilio Console
-   [ ] Go to: Messaging → WhatsApp → Sandbox
-   [ ] Lihat sandbox join instructions
-   [ ] Send message khusus ke nomor sandbox untuk join
-   [ ] Tunggu confirmation
-   [ ] Test lagi

**Solusi (untuk production):**

-   [ ] Pastikan nomor registered di WhatsApp Business
-   [ ] Cek di Twilio Console apakah nomor aktif

---

## 📊 QUICK REFERENCE

| Task                     | Command/Link                                          |
| ------------------------ | ----------------------------------------------------- |
| Twilio Console           | https://www.twilio.com/console                        |
| View Account SID & Token | https://www.twilio.com/console (dashboard)            |
| WhatsApp Sandbox         | https://www.twilio.com/console → Messaging → WhatsApp |
| Edit .env                | Open: `c:\projects\mlk-app\.env`                      |
| Run test                 | `php scripts/test_whatsapp_send.php`                  |
| Check logs               | `tail -f storage/logs/laravel.log`                    |
| View messages (DB)       | `php artisan tinker` → `ContactMessageReply::get()`   |

---

## 📱 EXPECTED BEHAVIOR

Setelah setup BERHASIL:

### Ketika Jalankan Test Script:

```
✅ Validasi konfigurasi Twilio
✅ Create contact message (phone: 085657104071)
✅ Send WhatsApp via Twilio API
✅ Save reply ke database
✅ Return status: "sent" atau "failed"
```

### Jika Sent (Success):

```
✅ Message terkirim ke Twilio
✅ Record simpan di database dengan status: "sent"
✅ Jika nomor join sandbox → message received
```

### Jika Failed:

```
⚠️ Error dari Twilio API (cek api_response)
⚠️ Message auto-save di whatsapp_outboxes (queue)
⚠️ Bisa retry nanti atau cek error di logs
```

---

## ✨ SELESAI CHECKLIST

-   [ ] Twilio account dibuat
-   [ ] Credentials diperoleh
-   [ ] WhatsApp sandbox di-setup
-   [ ] .env dikonfigurasi dengan credentials
-   [ ] Test script dijalankan & berhasil
-   [ ] Melihat "SUCCESS!" message
-   [ ] (Optional) Tested via admin dashboard
-   [ ] Database record ter-create dengan status "sent"

---

## 🎉 NEXT STEPS

✅ **Development/Testing:** Setup selesai, siap testing  
⏭️ **Production:** Read `TWILIO_SETUP.md` untuk production setup

---

**Last Updated:** 2025-11-17  
**Status:** ✅ Ready for Implementation  
**Estimated Time:** 20-30 minutes from start to "SUCCESS!" message
