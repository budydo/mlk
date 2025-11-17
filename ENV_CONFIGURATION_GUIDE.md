# Contoh .env Configuration untuk Twilio WhatsApp

> **JANGAN COPY-PASTE FILE INI!**
>
> File ini hanya CONTOH. Anda perlu isi dengan CREDENTIALS ANDA SENDIRI dari Twilio Console.

---

## 🎯 Contoh Setup dengan Annotations

```env
# ========== WhatsApp Configuration ==========

# WAJIB: Pilih provider yang digunakan
# Pilihan: 'twilio' | 'meta' | 'generic'
WHATSAPP_PROVIDER=twilio

# ========== TWILIO CONFIGURATION (Untuk WHATSAPP_PROVIDER=twilio) ==========

# DARI MANA DAPAT INI?
# → Buka: https://www.twilio.com/console
# → Di dashboard, lihat "Account SID"
# → Contoh: "AC4c5e12345678901234567890abcdef0"
TWILIO_ACCOUNT_SID=ACxxxxxxxxxxxxxxxxxxxxxxxx

# DARI MANA DAPAT INI?
# → Buka: https://www.twilio.com/console
# → Di dashboard, klik "Show" next to "Auth Token"
# → Copy nilai yang keluar (hati2, jangan ada spasi!)
# → Contoh: "a1b2c3d4e5f6g7h8i9j0k1l2m3n4o5p6"
TWILIO_AUTH_TOKEN=your_auth_token_here

# DARI MANA DAPAT INI?
# → Buka: https://www.twilio.com/console
# → Go to: Messaging → Try it Out → Send an SMS
# → Tab "WhatsApp" → Get Started
# → Akan dapat nomor sandbox Twilio
# → Contoh: "+1 415 523 8886" atau "+14155238886"
TWILIO_WHATSAPP_FROM=+14155238886

# ========== ALTERNATIVE PROVIDERS (Jika ingin ganti nanti) ==========

# JIKA INGIN PAKAI META (WhatsApp Cloud API):
# Uncomment dan isi di bawah, lalu ubah WHATSAPP_PROVIDER=meta
# WHATSAPP_PHONE_NUMBER_ID=123456789
# WHATSAPP_API_TOKEN=EAAF...

# JIKA INGIN PAKAI GENERIC (Service WhatsApp custom):
# Uncomment dan isi di bawah, lalu ubah WHATSAPP_PROVIDER=generic
# WHATSAPP_API_URL=https://your-service.com/api/send
# WHATSAPP_API_TOKEN=your_token_here
```

---

## 📋 Checklist: Sebelum Copy-Paste Credentials

Pastikan sudah:

-   [ ] Buat akun Twilio gratis (https://www.twilio.com/console)
-   [ ] Sudah login ke Twilio Console
-   [ ] Sudah lihat Account SID di dashboard
-   [ ] Sudah click "Show" untuk lihat Auth Token
-   [ ] Sudah setup WhatsApp Sandbox (Messaging → WhatsApp → Get Started)
-   [ ] Sudah dapatkan nomor sandbox Twilio
-   [ ] Copy credentials **TANPA SPASI** (avoid copy dari note app, gunakan langsung dari browser)

---

## 🔍 Contoh REAL (Dummy Values)

**JANGAN GUNAKAN INI! Ini hanya contoh format:**

```env
WHATSAPP_PROVIDER=twilio
TWILIO_ACCOUNT_SID=AC4c5e12345678901234567890abcdef0
TWILIO_AUTH_TOKEN=a1b2c3d4e5f6g7h8i9j0k1l2m3n4o5p6
TWILIO_WHATSAPP_FROM=+14155238886
```

**Format yang benar:**

-   ✅ Account SID mulai dengan `AC`
-   ✅ Auth Token panjang (32+ karakter)
-   ✅ WhatsApp FROM nomor dengan `+` prefix (international format)

---

## 🛠️ Langkah Detailed: Ambil Credentials

### Step 1: Account SID

```
1. Buka https://www.twilio.com/console
2. Login dengan akun Anda
3. Di halaman utama (dashboard), cari kotak "Account SID"
4. Copy nilai yang terlihat (format: ACxxx...)
5. Paste ke .env pada TWILIO_ACCOUNT_SID=
```

### Step 2: Auth Token

```
1. Di halaman yang sama (https://www.twilio.com/console)
2. Cari "Auth Token" (nilai **hidden**, tidak terlihat)
3. Click tombol "Show" atau "Toggle" untuk reveal token
4. Copy nilai yang keluar (jangan copy screenshot!)
5. Paste ke .env pada TWILIO_AUTH_TOKEN=
```

**⚠️ PENTING:**

-   Jangan ada spasi di awal/akhir
-   Jangan ada quotes
-   Jangan copy dari email/note yang mungkin ada spasi tambahan
-   Copy langsung dari Twilio Console di browser

### Step 3: WhatsApp Sandbox Number

```
1. Dari Twilio Console, buka:
   Messaging → Try it Out → Send an SMS
2. Di atas form, ada tab "WhatsApp"
3. Click "Get Started" atau "View Sandbox"
4. Akan muncul sandbox details, termasuk nomor Twilio
5. Contoh: "+1 415 523 8886"
6. Copy nomor ini (remove spasi) ke .env:
   TWILIO_WHATSAPP_FROM=+14155238886
```

---

## ✅ Verifikasi Credentials

Setelah diisi, verifikasi dengan script:

```bash
php scripts/test_whatsapp_send.php
```

**Jika benar:**

```
✅ Configuration looks good!
```

**Jika salah:**

```
❌ ERROR: Twilio config missing (...)
```

---

## 🚫 Common Mistakes

| Mistake      | Contoh Salah          | Contoh Benar          |
| ------------ | --------------------- | --------------------- |
| Ada spasi    | `AC xxxx yyyy`        | `ACxxxxyyyyy`         |
| Ada quotes   | `"ACxxxxx"`           | `ACxxxxx`             |
| Typo         | `TWILIO_ACCOUNT_IDD=` | `TWILIO_ACCOUNT_SID=` |
| Format nomor | `14155238886`         | `+14155238886`        |
| Wrong token  | Lama punya            | Baru dari Console     |

---

## 🔐 Security Notes

-   **Keep .env PRIVATE**: Jangan push ke git
-   **Change token regularly**: Jika exposed, buat token baru di Twilio Console
-   **Test credentials**: Verifikasi dengan script sebelum production
-   **.env in .gitignore**: Pastikan `.env` tidak di-track git

---

## 🔗 Links Cepat

-   Twilio Console: https://www.twilio.com/console
-   Account SID & Token: https://www.twilio.com/console (dashboard)
-   WhatsApp Setup: https://www.twilio.com/console → Messaging → WhatsApp
-   Twilio Docs: https://www.twilio.com/docs/whatsapp

---

Setelah credential diisi dengan benar → Jalankan: `php scripts/test_whatsapp_send.php` 🚀
