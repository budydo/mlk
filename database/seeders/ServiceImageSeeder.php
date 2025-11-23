<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;

class ServiceImageSeeder extends Seeder
{
    /**
     * Seed service images and icons dari Unsplash.
     */
    public function run(): void
    {
        // Update services dengan cover_image dan icon dari Unsplash
        $services = [
            [
                'slug' => 'amdal-kajian-dampak',
                'cover_image' => 'images/service/9.png',
                'icon' => 'https://images.unsplash.com/photo-1552664730-d307ca884978?q=80&w=100&auto=format&fit=crop',
            ],
            [
                'slug' => 'ukl-upl',
                'cover_image' => 'images/service/7.png',
                'icon' => 'https://images.unsplash.com/photo-1441974231531-c6227db76b6e?q=80&w=100&auto=format&fit=crop',
            ],
            [
                'slug' => 'sertifikat-laik-fungsi-dan-analisis-resiko',
                'cover_image' => 'images/service/8.png',
                'icon' => 'https://images.unsplash.com/photo-1552664730-d307ca884978?q=80&w=100&auto=format&fit=crop',
            ],
            [
                'slug' => 'persetujuan-bangunan-gedung',
                'cover_image' => 'images/service/6.png',
                'icon' => 'https://images.unsplash.com/photo-1489824904134-891ab64532f1?q=80&w=100&auto=format&fit=crop',
            ],
            [
                'slug' => 'izin-pengambilan-dan-pemanfaatan-air',
                'cover_image' => 'images/service/5.png',
                'icon' => 'https://images.unsplash.com/photo-1441974231531-c6227db76b6e?q=80&w=100&auto=format&fit=crop',
            ],
            [
                'slug' => 'perizinan-pengelolaan-lingkungan',
                'cover_image' => 'images/service/3.png',
                'icon' => 'https://images.unsplash.com/photo-1552664730-d307ca884978?q=80&w=100&auto=format&fit=crop',
            ],
            [
                'slug' => 'pemantauan-dampak',
                'cover_image' => 'images/service/2.png',
                'icon' => 'https://images.unsplash.com/photo-1611080626919-48bf4f92f90d?q=80&w=1200&auto=format&fit=crop',
            ],
            [
                'slug' => 'riset-dan-pengembangan',
                'cover_image' => 'images/service/1.png',
                'icon' => 'https://images.unsplash.com/photo-1552664730-d307ca884978?q=80&w=100&auto=format&fit=crop',
            ],
            [
                'slug' => 'pelatihan-kapasitas',
                'cover_image' => 'images/service/1.png',
                'icon' => 'https://images.unsplash.com/photo-1552664730-d307ca884978?q=80&w=100&auto=format&fit=crop',
            ],
            [
                'slug' => 'analisis-dampak-lalulintas',
                'cover_image' => 'images/service/4.png',
                'icon' => 'https://images.unsplash.com/photo-1552664730-d307ca884978?q=80&w=100&auto=format&fit=crop',
            ]
        ];

        foreach ($services as $serviceData) {
            Service::where('slug', $serviceData['slug'])
                ->update([
                    'cover_image' => $serviceData['cover_image'],
                    'icon' => $serviceData['icon'],
                ]);
        }

        $this->command->info('Service images berhasil diperbarui dengan gambar dari Unsplash.');
    }
}
