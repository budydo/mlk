<?php
/**
 * Script untuk debug dan verify Twilio WhatsApp credentials
 * Jalankan dengan: php scripts/debug_twilio.php
 */

require __DIR__ . '/../vendor/autoload.php';

$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\Log;

echo "=== TWILIO WHATSAPP CREDENTIALS DEBUG ===\n\n";

// 1. Check environment variables
echo "[1] Checking .env configuration...\n";
$sid = env('TWILIO_ACCOUNT_SID');
$token = env('TWILIO_AUTH_TOKEN');
$from = env('TWILIO_WHATSAPP_FROM');

echo "  TWILIO_ACCOUNT_SID: " . ($sid ? "✅ SET (length: " . strlen($sid) . ")" : "❌ EMPTY") . "\n";
echo "  TWILIO_AUTH_TOKEN: " . ($token ? "✅ SET (length: " . strlen($token) . ")" : "❌ EMPTY") . "\n";
echo "  TWILIO_WHATSAPP_FROM: " . ($from ? "✅ SET ($from)" : "❌ EMPTY") . "\n";

if (empty($sid) || empty($token) || empty($from)) {
    echo "\n❌ ERROR: Missing Twilio credentials in .env!\n";
    exit(1);
}

// 2. Check credentials format
echo "\n[2] Validating credentials format...\n";
if (!preg_match('/^AC[a-z0-9]{32}$/i', $sid)) {
    echo "  ⚠️  WARNING: TWILIO_ACCOUNT_SID format looks incorrect\n";
    echo "     Expected: AC[32 alphanumeric chars]\n";
    echo "     Got: $sid\n";
} else {
    echo "  ✅ TWILIO_ACCOUNT_SID format valid\n";
}

if (strlen($token) < 30) {
    echo "  ⚠️  WARNING: TWILIO_AUTH_TOKEN looks too short\n";
    echo "     Expected: ~32+ characters\n";
    echo "     Got: " . strlen($token) . " characters\n";
} else {
    echo "  ✅ TWILIO_AUTH_TOKEN length looks valid (" . strlen($token) . " chars)\n";
}

if (!preg_match('/^\+?\d{10,}$/', $from)) {
    echo "  ⚠️  WARNING: TWILIO_WHATSAPP_FROM format might be incorrect\n";
    echo "     Expected: +1234567890 or 1234567890\n";
    echo "     Got: $from\n";
} else {
    echo "  ✅ TWILIO_WHATSAPP_FROM format valid\n";
}

// 3. Try to test connection
echo "\n[3] Testing Twilio API connection...\n";
try {
    $client = new \Twilio\Rest\Client($sid, $token);
    
    // Get account info
    $account = $client->api->accounts->get($sid)->fetch();
    
    echo "  ✅ Successfully connected to Twilio API!\n";
    echo "     Account Status: " . $account->status . "\n";
    echo "     Account Created: " . $account->dateCreated . "\n";
    
    // 4. Test WhatsApp message creation (without sending)
    echo "\n[4] Testing WhatsApp message API...\n";
    
    // Use a test format
    $testPhone = "+6285657104071"; // nomor test Anda
    
    echo "     From: $from\n";
    echo "     To: $testPhone\n";
    echo "     Status: Ready to send\n";
    
    // Actually try to send a test message
    try {
        $message = $client->messages->create(
            "whatsapp:$testPhone",
            array(
                "from" => "whatsapp:$from",
                "body" => "Test message dari MLK App - " . date('Y-m-d H:i:s')
            )
        );
        
        echo "\n✅ SUCCESS! WhatsApp message sent!\n";
        echo "   Message SID: " . $message->sid . "\n";
        echo "   Status: " . $message->status . "\n";
        
    } catch (\Throwable $e) {
        echo "\n⚠️  Message send error (this is expected if not in sandbox):\n";
        echo "   Error: " . $e->getMessage() . "\n";
        
        // Check if it's a sandbox issue
        if (strpos($e->getMessage(), 'sandboxed') !== false) {
            echo "\n   💡 TIP: You're using Twilio WhatsApp Sandbox\n";
            echo "      To use sandbox, the recipient number must:\n";
            echo "      1. Send a test message TO Twilio's sandbox number\n";
            echo "      2. Then they can RECEIVE messages from your app\n";
            echo "\n   📱 Sandbox Number: " . $from . "\n";
            echo "   📝 Instructions:\n";
            echo "      1. Open WhatsApp on your phone\n";
            echo "      2. Send message 'join {code}' to " . $from . "\n";
            echo "      3. Check the Twilio console for the join code\n";
        }
    }
    
} catch (\Throwable $e) {
    echo "  ❌ ERROR connecting to Twilio API:\n";
    echo "     " . $e->getMessage() . "\n";
    echo "\n  Possible issues:\n";
    echo "     - Invalid TWILIO_ACCOUNT_SID\n";
    echo "     - Invalid TWILIO_AUTH_TOKEN\n";
    echo "     - Network/SSL issues (try: IGNORE_SSL_ERRORS=true in .env)\n";
    exit(1);
}

echo "\n=== END DEBUG ===\n";
