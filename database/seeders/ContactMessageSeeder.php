<?php

namespace Database\Seeders;

use App\Models\ContactMessage;
use Illuminate\Database\Seeder;

class ContactMessageSeeder extends Seeder
{
    /**
     * Seed contact messages contoh untuk testing reply dan WhatsApp integration.
     * 
     * Jalankan dengan: php artisan db:seed --class=ContactMessageSeeder
     */
    public function run(): void
    {
        $messages = [
            // Pesan 1 - Dengan nomor Indonesia
            [
                'name' => 'Budi Santoso',
                'email' => 'budi@example.com',
                'phone' => '6281234567890',  // Format internasional untuk WhatsApp
                'subject' => 'Pertanyaan tentang layanan web development',
                'message' => 'Halo, saya ingin menanyakan tentang paket layanan web development. Berapa estimasi waktu untuk membuat website e-commerce dengan 100+ produk?',
                'source' => 'website',
                'is_handled' => false,
            ],
            // Pesan 2
            [
                'name' => 'Siti Maryam',
                'email' => 'siti@example.com',
                'phone' => '6285678901234',
                'subject' => 'Konsultasi branding untuk startup',
                'message' => 'Kami adalah startup baru di bidang fintech. Kami butuh konsultasi branding dan design untuk aplikasi mobile kami.',
                'source' => 'website',
                'is_handled' => false,
            ],
            // Pesan 3 - Sudah ditangani
            [
                'name' => 'Ahmad Wijaya',
                'email' => 'ahmad@example.com',
                'phone' => '6287654321098',
                'subject' => 'Follow-up: Project website sudah selesai',
                'message' => 'Terima kasih untuk website yang sudah dikerjakan. Hasilnya sangat memuaskan dan sesuai dengan requirement kami.',
                'source' => 'website',
                'is_handled' => true,
            ],
            // Pesan 4 - Tanpa nomor telepon
            [
                'name' => 'Ratna Sari',
                'email' => 'ratna@example.com',
                'phone' => null,  // Tidak ada nomor telepon - balasan hanya via email
                'subject' => 'Permintaan proposal untuk redesign website',
                'message' => 'Website kami sudah lama dan perlu di-update. Bisa kirim proposal dengan detail harga dan timeline?',
                'source' => 'website',
                'is_handled' => false,
            ],
            // Pesan 5
            [
                'name' => 'Hendra Kusuma',
                'email' => 'hendra@example.com',
                'phone' => '6289876543210',
                'subject' => 'Partnership inquiry',
                'message' => 'Apakah Anda terbuka untuk partnership atau kolaborasi project? Saya adalah project manager di perusahaan advertising yang sering butuh vendor IT.',
                'source' => 'website',
                'is_handled' => false,
            ],
        ];

        // Looping dan insert setiap pesan
        foreach ($messages as $message) {
            ContactMessage::create($message);
        }

        $this->command->info('✅ ' . count($messages) . ' sample contact messages berhasil dibuat untuk testing!');
    }
}
