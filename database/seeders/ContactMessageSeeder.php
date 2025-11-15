<?php

namespace Database\Seeders;

use App\Models\ContactMessage;
use Illuminate\Database\Seeder;

class ContactMessageSeeder extends Seeder
{
    /**
     * Seed contact messages contoh untuk testing.
     */
    public function run(): void
    {
        $messages = [
            [
                'name' => 'Budi Santoso',
                'email' => 'budi@example.com',
                'phone' => '081234567890',
                'message' => 'Konsultasi Proyek Restorasi\n\nKami tertarik untuk berkonsultasi mengenai proyek restorasi hutan mangrove di Kabupaten Bangkalan. Bisakah Anda memberikan informasi lebih lanjut tentang layanan dan estimasi biaya?',
                'source' => 'website',
                'is_handled' => false,
            ],
            [
                'name' => 'Siti Maryam',
                'email' => 'siti@example.com',
                'phone' => '082345678901',
                'message' => 'Pertanyaan AMDAL\n\nKami sedang merencanakan pembangunan pabrik dan memerlukan AMDAL. Dapatkah Anda menjelaskan proses dan timeline yang diperlukan?',
                'source' => 'website',
                'is_handled' => false,
            ],
            [
                'name' => 'Ahmad Wijaya',
                'email' => 'ahmad@example.com',
                'phone' => '083456789012',
                'message' => 'Pemberdayaan Komunitas\n\nKomunitas kami ingin melakukan program pemberdayaan. Bagaimana cara menghubungi tim Anda untuk konsultasi lebih lanjut?',
                'source' => 'website',
                'is_handled' => false,
            ],
            [
                'name' => 'Ratna Sari',
                'email' => 'ratna@example.com',
                'phone' => '084567890123',
                'message' => 'ANDALALIN untuk Proyek Jalan Tol\n\nProyek jalan tol baru memerlukan analisis dampak lalu lintas. Bagaimana metodologi Anda dalam melakukan ANDALALIN?',
                'source' => 'website',
                'is_handled' => false,
            ],
            [
                'name' => 'Hendra Kusuma',
                'email' => 'hendra@example.com',
                'phone' => '085678901234',
                'message' => 'Audit Lingkungan\n\nFasilitas produksi kami ingin melakukan audit lingkungan untuk sertifikasi ISO 14001. Dapatkah Anda membantu?',
                'source' => 'website',
                'is_handled' => false,
            ],
        ];

        foreach ($messages as $messageData) {
            ContactMessage::updateOrCreate(
                ['email' => $messageData['email']],
                $messageData
            );
        }

        $this->command->info('Contact messages contoh telah ditambahkan untuk testing.');
    }
}
