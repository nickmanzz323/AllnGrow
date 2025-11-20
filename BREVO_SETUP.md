# Setup Brevo Email Service untuk AllnGrow

## Mengapa Brevo?
- ✅ **300 email/hari GRATIS** (vs 100/hari SendGrid)
- ✅ Email marketing & newsletter included
- ✅ SMS notification (9 SMS gratis)
- ✅ Contact management
- ✅ User-friendly dashboard

---

## Langkah 1: Daftar Akun Brevo

1. Buka https://www.brevo.com/
2. Klik **"Sign up free"**
3. Isi form registrasi:
   - Email address
   - Password
   - Company name: **AllnGrow**
4. Verify email Anda
5. Login ke dashboard Brevo

---

## Langkah 2: Dapatkan SMTP Credentials

1. Login ke Brevo dashboard
2. Klik nama Anda di kanan atas → **"SMTP & API"**
3. Di tab **"SMTP"**, Anda akan lihat:
   - **SMTP Server**: `smtp-relay.brevo.com`
   - **Port**: `587` (recommended) atau `465`
   - **Login**: email Anda yang terdaftar
   - **SMTP Key**: Klik **"Create a new SMTP key"**
     - Beri nama: `AllnGrow Production`
     - Copy key yang muncul (hanya muncul 1x!)

---

## Langkah 3: Update File .env

Buka file `.env` di root project dan update bagian MAIL:

```env
MAIL_MAILER=smtp
MAIL_HOST=smtp-relay.brevo.com
MAIL_PORT=587
MAIL_USERNAME=your-brevo-email@gmail.com
MAIL_PASSWORD=your-brevo-smtp-key
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="noreply@allngrow.com"
MAIL_FROM_NAME="AllnGrow"
```

**Ganti:**
- `MAIL_USERNAME` → Email yang Anda gunakan untuk daftar Brevo
- `MAIL_PASSWORD` → SMTP Key yang Anda copy di Langkah 2

---

## Langkah 4: Verify Sender Email (PENTING!)

Brevo mengharuskan Anda verify sender email agar email tidak masuk spam.

### Option A: Verify Single Email (Mudah)

1. Di Brevo dashboard → **"Senders, Domains & Dedicated IPs"**
2. Tab **"Senders"** → Klik **"Add a sender"**
3. Masukkan:
   - **Email**: `noreply@allngrow.com` (atau email Anda)
   - **Name**: `AllnGrow`
4. Klik **"Add"**
5. Brevo akan kirim verification email → Klik link verifikasi
6. **DONE!** Email sudah bisa digunakan

### Option B: Verify Domain (Advanced - Recommended untuk Production)

Jika Anda punya domain `allngrow.com`:

1. Di Brevo dashboard → **"Senders, Domains & Dedicated IPs"**
2. Tab **"Domains"** → Klik **"Add a domain"**
3. Masukkan domain: `allngrow.com`
4. Brevo akan memberikan **DNS records** (SPF, DKIM, DMARC)
5. Tambahkan DNS records ini di domain registrar Anda (Namecheap, GoDaddy, dll)
6. Tunggu propagasi DNS (bisa 24-48 jam)
7. Klik **"Verify"** di Brevo
8. **DONE!** Semua email dari `@allngrow.com` akan verified

---

## Langkah 5: Test Email

Jalankan command berikut untuk test:

```bash
php artisan tinker
```

Kemudian ketik:

```php
Mail::raw('Test email from AllnGrow via Brevo', function ($message) {
    $message->to('your-email@gmail.com')
            ->subject('Test Email AllnGrow');
});
```

Cek inbox Anda. Jika email masuk, **setup berhasil!**

---

## Langkah 6: Test Password Reset

1. Buka browser → http://192.168.50.38:8001/login
2. Klik **"Forgot Password?"**
3. Masukkan email student yang sudah terdaftar
4. Klik **"Send Reset Link"**
5. Cek inbox email student tersebut
6. Klik link di email → Reset password
7. Login dengan password baru

**Jika semua langkah berhasil, password reset sudah production-ready!**

---

## Troubleshooting

### Email tidak terkirim?

**1. Check .env:**
```bash
php artisan config:clear
php artisan cache:clear
```

**2. Check SMTP credentials benar:**
- Login email Brevo sudah benar?
- SMTP key sudah benar?

**3. Check sender email verified:**
- Pastikan `MAIL_FROM_ADDRESS` sudah verified di Brevo

**4. Check logs:**
```bash
tail -f storage/logs/laravel.log
```

### Email masuk spam?

**Solusi:**
1. Verify domain (bukan hanya email)
2. Tambahkan SPF, DKIM, DMARC records
3. Warming up: Kirim email sedikit dulu, naikkan bertahap

---

## Free Tier Limits

- **300 email/hari** (9,000/bulan)
- **9 SMS gratis**
- **Unlimited contacts**
- Email tracking & analytics
- Marketing automation

Jika butuh lebih:
- **Lite Plan**: $25/bulan → 20,000 email/bulan
- **Business Plan**: $65/bulan → 100,000 email/bulan

---

## Tips Production

1. **Monitor quota**: Cek dashboard Brevo setiap hari
2. **Implement queue**: Untuk banyak email, pakai queue agar tidak block
3. **Add email templates**: Buat template profesional di Brevo dashboard
4. **Enable tracking**: Track open rate, click rate di Brevo
5. **Backup SMTP key**: Simpan di password manager

---

## Kembali ke Mailtrap (Development)

Jika mau balik ke testing mode:

```env
MAIL_MAILER=smtp
MAIL_HOST=sandbox.smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=250fcde4ccfa99
MAIL_PASSWORD=f60c4c4160b74f
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="noreply@allngrow.com"
MAIL_FROM_NAME="AllnGrow"
```

---

## Support

- Brevo Documentation: https://developers.brevo.com/
- Brevo Support: https://help.brevo.com/
- Laravel Mail Documentation: https://laravel.com/docs/mail

**Setup by Claude Code for AllnGrow Project**
