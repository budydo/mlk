<?php

namespace Database\Seeders;

use App\Models\HomeContent;
use Illuminate\Database\Seeder;

class HomeContentImageSeeder extends Seeder
{
    /**
     * Seed home content slider images dari Unsplash dengan tema yang sesuai.
     */
    public function run(): void
    {
        $homeContents = [
            [
                'order' => 1,
                'image_path' => 'images/home/tentang.png',
            ],
            [
                'order' => 2,
                'image_path' => 'images/home/8.png',
            ],
            [
                'order' => 3,
                'image_path' => 'images/home/3.png',
            ],
            [
                'order' => 4,
                'image_path' => 'images/home/10.png',
            ],
            [
                'order' => 5,
                'image_path' => 'images/home/5.png',
            ],
        ];

        foreach ($homeContents as $contentData) {
            HomeContent::where('order', $contentData['order'])
                ->update(['image_path' => $contentData['image_path']]);
        }

        $this->command->info('Home content slider images berhasil diperbarui dengan gambar dari Unsplash.');
    }
}
