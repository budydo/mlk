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
                'cover_image' => 'https://images.unsplash.com/photo-1552664730-d307ca884978?q=80&w=1200&auto=format&fit=crop',
                'icon' => 'https://images.unsplash.com/photo-1552664730-d307ca884978?q=80&w=100&auto=format&fit=crop',
            ],
            [
                'slug' => 'restorasi-lahan',
                'cover_image' => 'https://images.unsplash.com/photo-1441974231531-c6227db76b6e?q=80&w=1200&auto=format&fit=crop',
                'icon' => 'https://images.unsplash.com/photo-1441974231531-c6227db76b6e?q=80&w=100&auto=format&fit=crop',
            ],
            [
                'slug' => 'pemberdayaan-komunitas',
                'cover_image' => 'https://images.unsplash.com/photo-1552664730-d307ca884978?q=80&w=1200&auto=format&fit=crop',
                'icon' => 'https://images.unsplash.com/photo-1552664730-d307ca884978?q=80&w=100&auto=format&fit=crop',
            ],
            [
                'slug' => 'transportasi-manajemen-lalu-lintas',
                'cover_image' => 'https://images.unsplash.com/photo-1489824904134-891ab64532f1?q=80&w=1200&auto=format&fit=crop',
                'icon' => 'https://images.unsplash.com/photo-1489824904134-891ab64532f1?q=80&w=100&auto=format&fit=crop',
            ],
            [
                'slug' => 'lingkungan-hidup-berkelanjutan',
                'cover_image' => 'https://images.unsplash.com/photo-1441974231531-c6227db76b6e?q=80&w=1200&auto=format&fit=crop',
                'icon' => 'https://images.unsplash.com/photo-1441974231531-c6227db76b6e?q=80&w=100&auto=format&fit=crop',
            ],
            [
                'slug' => 'konsultasi-lingkungan',
                'cover_image' => 'https://images.unsplash.com/photo-1552664730-d307ca884978?q=80&w=1200&auto=format&fit=crop',
                'icon' => 'https://images.unsplash.com/photo-1552664730-d307ca884978?q=80&w=100&auto=format&fit=crop',
            ],
            [
                'slug' => 'pemantauan-dampak',
                'cover_image' => 'https://images.unsplash.com/photo-1611080626919-48bf4f92f90d?q=80&w=1200&auto=format&fit=crop',
                'icon' => 'https://images.unsplash.com/photo-1611080626919-48bf4f92f90d?q=80&w=100&auto=format&fit=crop',
            ],
            [
                'slug' => 'riset-dan-pengembangan',
                'cover_image' => 'https://images.unsplash.com/photo-1552664730-d307ca884978?q=80&w=1200&auto=format&fit=crop',
                'icon' => 'https://images.unsplash.com/photo-1552664730-d307ca884978?q=80&w=100&auto=format&fit=crop',
            ],
            [
                'slug' => 'pelatihan-kapasitas',
                'cover_image' => 'https://images.unsplash.com/photo-1552664730-d307ca884978?q=80&w=1200&auto=format&fit=crop',
                'icon' => 'https://images.unsplash.com/photo-1552664730-d307ca884978?q=80&w=100&auto=format&fit=crop',
            ],
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
