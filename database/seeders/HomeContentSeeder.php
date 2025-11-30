<?php

namespace Database\Seeders;

use App\Models\HomeContent;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

/**
 * HomeContentSeeder — Mengisi data konten hero slider pada halaman beranda.
 */
class HomeContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /**
         * Data hero slider dengan konten yang relevan untuk perusahaan konsultan lingkungan.
         * Gambar diambil dari folder publicbuild/images/home_hero.
         * Pastikan gambar tersedia dengan nama yang sesuai.
         */
        $contents = [
            [
                'order' => 1,
                'title' => 'Restorasi Lahan & Pemulihan Ekosistem',
                'description' => 'Program revegetasi, rehabilitasi, dan pemantauan agar fungsi ekologis pulih dan komunitas berdaya.',
                'image_path' => 'build/images/home_hero/restorasi-lahan.jpg',
                'button_text' => 'Lihat Studi Kasus',
                'button_url' => '#projects',
                'is_published' => true,
            ],
            [
                'order' => 2,
                'title' => 'AMDAL & Studi Dampak Yang Kuat',
                'description' => 'Dokumen teknis komprehensif dan rekomendasi mitigasi yang dapat dipertanggungjawabkan.',
                'image_path' => 'build/images/home_hero/amdal.jpg',
                'button_text' => 'Lihat Layanan',
                'button_url' => '#services',
                'is_published' => true,
            ],
            [
                'order' => 3,
                'title' => 'Pemberdayaan Komunitas & Dampak Sosial',
                'description' => 'Program yang memperkuat kapasitas lokal untuk hasil yang berkelanjutan dan berdampak positif.',
                'image_path' => 'build/images/home_hero/pemberdayaan.jpg',
                'button_text' => 'Study Pemberdayaan',
                'button_url' => '#projects',
                'is_published' => true,
            ],
            [
                'order' => 4,
                'title' => 'Analisis & Pengendalian Transportasi',
                'description' => 'ANDALALIN, sistem manajemen lalu lintas, dan mitigasi dampak transportasi untuk proyek infrastruktur.',
                'image_path' => 'build/images/home_hero/transportasi.jpg',
                'button_text' => 'Lihat Layanan Transportasi',
                'button_url' => '#services',
                'is_published' => true,
            ],
            [
                'order' => 5,
                'title' => 'Pengelolaan Lingkungan Hidup Berkelanjutan',
                'description' => 'Strategi komprehensif untuk mitigasi dampak lingkungan, kepatuhan regulasi, dan pembangunan berkelanjutan.',
                'image_path' => 'build/images/home_hero/lingkungan.jpg',
                'button_text' => 'Lihat Solusi Lingkungan',
                'button_url' => '#services',
                'is_published' => true,
            ],
        ];

        /**
         * Hapus konten yang sudah ada (opsional, hanya saat testing).
         * Uncomment jika ingin reset konten setiap kali seeding.
         */
        // HomeContent::truncate();

        /**
         * Insert data konten menggunakan createMany (lebih efisien daripada loop).
         */
        HomeContent::insertOrIgnore($contents);

        $this->command->info('HomeContent seeder berhasil dijalankan: ' . count($contents) . ' slide telah ditambahkan.');
    }
}
