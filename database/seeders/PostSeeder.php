<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Post;
use Illuminate\Support\Str;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sample = [
            [
                'title' => 'Restorasi Lahan: Pendekatan Partisipatif',
                'excerpt' => 'Pendekatan partisipatif meningkatkan keberlanjutan program restorasi lahan.',
                'content' => '<p>Contoh konten lengkap artikel tentang restorasi lahan dengan pendekatan partisipatif.</p>',
            ],
            [
                'title' => 'Membangun Kapasitas Komunitas Lokal',
                'excerpt' => 'Pentingnya pelatihan dan pelibatan komunitas dalam setiap proyek lingkungan.',
                'content' => '<p>Contoh artikel mengenai kapasitas komunitas.</p>',
            ],
            [
                'title' => 'Metode Monitoring & Evaluasi Proyek',
                'excerpt' => 'Metode sederhana untuk memantau hasil ekologis dan sosial proyek.',
                'content' => '<p>Metode M&E yang praktis untuk proyek restorasi.</p>',
            ],
            [
                'title' => 'Pemilihan Spesies untuk Revegetasi',
                'excerpt' => 'Panduan memilih spesies yang cocok untuk revegetasi lahan terdegradasi.',
                'content' => '<p>Tips memilih spesies asli lokal.</p>',
            ],
            [
                'title' => 'Studi Kasus: Keberhasilan Proyek Desa Seruni',
                'excerpt' => 'Ringkasan hasil dan pelajaran dari proyek di Desa Seruni.',
                'content' => '<p>Deskripsi studi kasus dan hasil nyata di lapangan.</p>',
            ],
            [
                'title' => 'Perizinan Lingkungan: Panduan Praktis',
                'excerpt' => 'Langkah-langkah perizinan untuk proyek restorasi dan pembangunan berkelanjutan.',
                'content' => '<p>Alur perizinan dan dokumen pendukung yang diperlukan.</p>',
            ],
        ];

        foreach ($sample as $item) {
            $slug = Str::slug($item['title']);
            Post::create([
                'title' => $item['title'],
                'slug' => $slug . '-' . substr(Str::random(5),0,5),
                'excerpt' => $item['excerpt'],
                'content' => $item['content'],
                'cover_image' => null,
                'is_published' => true,
                'published_at' => now()->subDays(rand(0,30)),
            ]);
        }
    }
}
