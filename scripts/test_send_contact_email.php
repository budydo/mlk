<?php
// Skrip test untuk membuat ContactMessage dan mengirim email notifikasi ke admin.
// Komentar dalam bahasa Indonesia untuk memudahkan pembelajaran.

// Load autoload dan bootstrap aplikasi Laravel
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\ContactMessage;
use Illuminate\Support\Facades\Mail;

// Data pesan kontak untuk pengujian
$testData = [
    'name' => 'Penguji Otomatis',
    'email' => 'javiku313@gmail.com', // email pengirim sesuai permintaan
    'phone' => '+6281234567890',
    'message' => 'Ini adalah pesan uji coba dari skrip test_send_contact_email.php',
    'subject' => 'Tes Kontak',
    'source' => 'script-test',
];

try {
    // 1) Simpan pesan ke database (seperti yang dilakukan oleh form sebenarnya)
    $msg = ContactMessage::create([
        'name' => $testData['name'],
        'email' => $testData['email'],
        'phone' => $testData['phone'],
        'message' => $testData['message'],
        'subject' => $testData['subject'],
        'source' => $testData['source'],
    ]);

    // 2) Kirim email notifikasi ke alamat perusahaan (menggunakan konfigurasi di aplikasi)
    //    Di ContactController digunakan: config('mail.contact_address', env('MAIL_CONTACT_ADDRESS', 'info@example.com'))
    $to = config('mail.contact_address', env('MAIL_CONTACT_ADDRESS', 'info@example.com'));

    // Gunakan Mail::raw agar mirip dengan behavior di ContactController
    Mail::raw("Pesan kontak baru dari {$msg->name}:\n\n{$msg->message}\n\nEmail: {$msg->email}\nTelepon: {$msg->phone}", function ($m) use ($to) {
        // Di sini kita set penerima dan subject email
        $m->to($to)->subject('Pesan Kontak Baru (Tes)');
    });

    echo "Pesan kontak dibuat dan email notifikasi dikirim (atau di-log).\n";
    echo "ContactMessage ID: " . $msg->id . "\n";
    echo "Notifikasi dikirim ke: {$to}\n";
} catch (Throwable $e) {
    // Tangani error: tampilkan pesan agar mudah debugging
    echo "Terjadi error saat mengirim notifikasi: " . $e->getMessage() . "\n";
    // Juga tulis ke log jika perlu
    report($e);
}
