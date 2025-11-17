<?php

namespace Database\Seeders;

use App\Models\ContactMessage;
use Illuminate\Database\Seeder;

/**
 * Seeder untuk menambahkan satu pesan kontak dengan nomor testing.
 * Nomor yang Anda berikan: 085657104071 -> disimpan dalam format internasional: 6285657104071
 */
class TestContactNumberSeeder extends Seeder
{
    public function run(): void
    {
        ContactMessage::create([
            'name' => 'Test Pengirim',
            'email' => 'test-pengirim@example.com',
            'phone' => '6285657104071', // format internasional untuk WhatsApp
            'subject' => 'Test Pengiriman WhatsApp',
            'message' => 'Ini pesan uji untuk mengirim balasan ke nomor yang Anda berikan.',
            'source' => 'test-seeder',
            'is_handled' => false,
        ]);

        $this->command->info('✅ Test contact message dibuat dengan nomor 6285657104071');
    }
}
