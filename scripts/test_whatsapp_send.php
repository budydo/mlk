<?php
/**
 * Testing Script untuk WhatsApp Integration via Twilio
 * 
 * Script ini akan:
 * 1. Membuat contact message baru dengan nomor 085657104071
 * 2. Mengirim reply via MessageReplyService
 * 3. Menampilkan status pengiriman
 * 
 * Persyaratan:
 * - .env sudah dikonfigurasi dengan Twilio credentials
 * - Database sudah di-setup
 */

require __DIR__ . '/../vendor/autoload.php';

$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\ContactMessage;
use App\Models\User;
use App\Services\MessageReplyService;

echo "======================================\n";
echo "WhatsApp Integration Testing (Twilio)\n";
echo "======================================\n\n";

// 1. Cek konfigurasi Twilio
echo "[1] Checking Twilio Configuration...\n";
$provider = env('WHATSAPP_PROVIDER');
$sid = env('TWILIO_ACCOUNT_SID');
$token = env('TWILIO_AUTH_TOKEN');
$from = env('TWILIO_WHATSAPP_FROM');

echo "  Provider: {$provider}\n";
echo "  Account SID: " . substr($sid, 0, 4) . "..." . substr($sid, -4) . "\n";
echo "  Auth Token: " . (strlen($token) > 0 ? "***" . substr($token, -4) : "NOT SET") . "\n";
echo "  From Number: {$from}\n";

if ($provider !== 'twilio') {
    echo "\n❌ ERROR: WHATSAPP_PROVIDER must be 'twilio'. Current: {$provider}\n";
    exit(1);
}

if (empty($sid) || empty($token) || empty($from)) {
    echo "\n❌ ERROR: Twilio credentials not fully configured in .env\n";
    echo "   Please set:\n";
    echo "   - TWILIO_ACCOUNT_SID\n";
    echo "   - TWILIO_AUTH_TOKEN\n";
    echo "   - TWILIO_WHATSAPP_FROM\n";
    exit(1);
}

echo "✅ Configuration looks good!\n\n";

// 2. Buat atau cari contact message dengan nomor target
echo "[2] Creating/Finding Contact Message...\n";
$targetPhone = '085657104071';
$contact = ContactMessage::where('phone', $targetPhone)->first();

if (!$contact) {
    $contact = ContactMessage::create([
        'name' => 'Test User',
        'email' => 'test@example.com',
        'phone' => $targetPhone,
        'subject' => 'Test WhatsApp Integration',
        'message' => 'This is a test message to verify WhatsApp integration',
        'is_handled' => false,
    ]);
    echo "  Created new contact message (ID: {$contact->id})\n";
} else {
    echo "  Found existing contact message (ID: {$contact->id})\n";
}

echo "  Phone: {$contact->phone}\n";
echo "  Email: {$contact->email}\n\n";

// 3. Ambil user (admin) untuk audit trail
echo "[3] Finding Admin User...\n";
$user = User::first();
if ($user) {
    echo "  Admin: {$user->name} ({$user->email})\n\n";
} else {
    echo "  ⚠️  No admin user found (continuing with null)\n\n";
}

// 4. Send reply via MessageReplyService
echo "[4] Sending WhatsApp Message...\n";
echo "  Target: {$targetPhone}\n";

$testMessage = "Hello from MLK App! 🎉\nThis is an automated test message to verify WhatsApp integration.\nTime: " . now()->format('Y-m-d H:i:s');
echo "  Message: " . str_replace("\n", "\\n", $testMessage) . "\n\n";

/** @var MessageReplyService $service */
$service = $app->make(MessageReplyService::class);

try {
    $reply = $service->sendReply($contact, $testMessage, $user);
    
    echo "✅ REPLY CREATED:\n";
    echo "  ID: {$reply->id}\n";
    echo "  Email Status: {$reply->email_status}\n";
    echo "  WhatsApp Status: {$reply->whatsapp_status}\n";
    
    if (!empty($reply->api_response)) {
        echo "  API Response:\n";
        $response = is_array($reply->api_response) ? $reply->api_response : json_decode($reply->api_response, true);
        echo "    " . json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) . "\n";
    }
    
    echo "\n";
    if ($reply->whatsapp_status === 'sent') {
        echo "🎉 SUCCESS! WhatsApp message sent to {$targetPhone}\n";
    } elseif ($reply->whatsapp_status === 'failed') {
        echo "⚠️  WhatsApp message failed to send. Check API response above.\n";
    } elseif ($reply->whatsapp_status === 'queued') {
        echo "⏳ Message queued in outbox (API failed but saved for retry)\n";
    } else {
        echo "❓ Status: {$reply->whatsapp_status}\n";
    }
    
    exit(0);
} catch (Throwable $e) {
    echo "❌ ERROR: " . $e->getMessage() . "\n";
    echo "Trace: " . $e->getTraceAsString() . "\n";
    exit(1);
}
