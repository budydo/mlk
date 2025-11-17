<?php
// Skrip sederhana untuk men-trigger MessageReplyService tanpa masuk ke Tinker interaktif
require __DIR__ . '/../vendor/autoload.php';

$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\ContactMessage;
use App\Models\User;

// Ambil contact pertama yang punya nomor telepon
$contact = ContactMessage::whereNotNull('phone')->first();
if (! $contact) {
    echo "No contact with phone number found. Create one in DB first.\n";
    exit(1);
}

// Ambil user (admin) pertama, jika tidak ada set null
$user = User::first();

/** @var \App\Services\MessageReplyService $service */
$service = $app->make(\App\Services\MessageReplyService::class);

try {
    $reply = $service->sendReply($contact, 'Test message from MLK App (automated test)', $user);
    echo "Reply created. ID: " . ($reply->id ?? 'n/a') . "\n";
    echo "Email status: " . ($reply->email_status ?? '') . "\n";
    echo "WhatsApp status: " . ($reply->whatsapp_status ?? '') . "\n";
    echo "API response: " . json_encode($reply->api_response) . "\n";
    exit(0);
} catch (Throwable $e) {
    echo "Error running test: " . $e->getMessage() . "\n";
    exit(1);
}
