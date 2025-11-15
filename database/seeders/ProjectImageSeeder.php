<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Seeder;

class ProjectImageSeeder extends Seeder
{
    /**
     * Seed project cover images dari Unsplash dengan tema yang sesuai.
     */
    public function run(): void
    {
        $projectImages = [
            [
                'slug' => 'restorasi-hutan-pesisir-bangkalan',
                'cover_image' => 'https://images.unsplash.com/photo-1441974231531-c6227db76b6e?q=80&w=1200&auto=format&fit=crop',
            ],
            [
                'slug' => 'amdal-plta-sulawesi',
                'cover_image' => 'https://images.unsplash.com/photo-1552664730-d307ca884978?q=80&w=1200&auto=format&fit=crop',
            ],
            [
                'slug' => 'ukl-upl-kopi-jatim',
                'cover_image' => 'https://images.unsplash.com/photo-1441974231531-c6227db76b6e?q=80&w=1200&auto=format&fit=crop',
            ],
            [
                'slug' => 'andalalin-tol-jakarta',
                'cover_image' => 'https://images.unsplash.com/photo-1489824904134-891ab64532f1?q=80&w=1200&auto=format&fit=crop',
            ],
            [
                'slug' => 'penghijauan-urban-surabaya',
                'cover_image' => 'https://images.unsplash.com/photo-1441974231531-c6227db76b6e?q=80&w=1200&auto=format&fit=crop',
            ],
            [
                'slug' => 'audit-lingkungan-manufaktur',
                'cover_image' => 'https://images.unsplash.com/photo-1552664730-d307ca884978?q=80&w=1200&auto=format&fit=crop',
            ],
            [
                'slug' => 'manajemen-limbah-tambang',
                'cover_image' => 'https://images.unsplash.com/photo-1611080626919-48bf4f92f90d?q=80&w=1200&auto=format&fit=crop',
            ],
            [
                'slug' => 'sistem-water-management-kalimantan',
                'cover_image' => 'https://images.unsplash.com/photo-1441974231531-c6227db76b6e?q=80&w=1200&auto=format&fit=crop',
            ],
            [
                'slug' => 'program-konservasi-laut-nusa-tenggara',
                'cover_image' => 'https://images.unsplash.com/photo-1505142468610-359e7d316be0?q=80&w=1200&auto=format&fit=crop',
            ],
            [
                'slug' => 'energi-terbarukan-di-sulawesi-barat',
                'cover_image' => 'https://images.unsplash.com/photo-1489824904134-891ab64532f1?q=80&w=1200&auto=format&fit=crop',
            ],
            [
                'slug' => 'biodiversity-assessment-papua',
                'cover_image' => 'https://images.unsplash.com/photo-1441974231531-c6227db76b6e?q=80&w=1200&auto=format&fit=crop',
            ],
            [
                'slug' => 'iso-14001-implementasi-sumatra',
                'cover_image' => 'https://images.unsplash.com/photo-1552664730-d307ca884978?q=80&w=1200&auto=format&fit=crop',
            ],
        ];

        foreach ($projectImages as $projectData) {
            Project::where('slug', $projectData['slug'])
                ->update(['cover_image' => $projectData['cover_image']]);
        }

        $this->command->info('Project cover images berhasil diperbarui dengan gambar dari Unsplash.');
    }
}
