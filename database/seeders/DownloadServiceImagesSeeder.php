<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;

class DownloadServiceImagesSeeder extends Seeder
{
    public function run(): void
    {
        $baseDir = public_path('images/services');
        
        // Create directory if not exists
        if (!is_dir($baseDir)) {
            mkdir($baseDir, 0755, true);
        }

        $images = [
            'ukl-upl.jpg' => 'https://images.unsplash.com/photo-1454165804606-c3d57bc86b40?w=800&h=500&fit=crop',
            'amdal-kajian-dampak.jpg' => 'https://images.unsplash.com/photo-1552664730-d307ca884978?w=800&h=500&fit=crop',
            'pemberdayaan-komunitas.jpg' => 'https://images.unsplash.com/photo-1552664730-d307ca884978?w=800&h=500&fit=crop',
            'restorasi-lahan.jpg' => 'https://images.unsplash.com/photo-1441974231531-c6227db76b6e?w=800&h=500&fit=crop',
            'transportasi-manajemen-lalu-lintas.jpg' => 'https://images.unsplash.com/photo-1489824904134-891ab64532f1?w=800&h=500&fit=crop',
            'lingkungan-hidup-berkelanjutan.jpg' => 'https://images.unsplash.com/photo-1441974231531-c6227db76b6e?w=800&h=500&fit=crop',
            'konsultasi-lingkungan.jpg' => 'https://images.unsplash.com/photo-1552664730-d307ca884978?w=800&h=500&fit=crop',
            'pemantauan-dampak.jpg' => 'https://images.unsplash.com/photo-1611080626919-48bf4f92f90d?w=800&h=500&fit=crop',
            'riset-dan-pengembangan.jpg' => 'https://images.unsplash.com/photo-1454165804606-c3d57bc86b40?w=800&h=500&fit=crop',
            'pelatihan-kapasitas.jpg' => 'https://images.unsplash.com/photo-1552664730-d307ca884978?w=800&h=500&fit=crop',
        ];

        foreach ($images as $filename => $url) {
            $filepath = $baseDir . '/' . $filename;
            
            // Skip if file already exists
            if (file_exists($filepath)) {
                $this->command->info('File exists: ' . $filename);
                continue;
            }
            
            try {
                $this->command->info('Downloading: ' . $filename);
                $response = Http::timeout(30)->withoutVerifying()->get($url);
                
                if ($response->successful()) {
                    file_put_contents($filepath, $response->body());
                    $this->command->info('Downloaded: ' . $filename);
                } else {
                    $this->command->error('Failed to download: ' . $filename);
                }
            } catch (\Exception $e) {
                $this->command->error('Error downloading ' . $filename . ': ' . $e->getMessage());
            }
        }
        
        $this->command->info('Image download completed!');
    }
}
