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
                'image_path' => 'https://images.unsplash.com/photo-1441974231531-c6227db76b6e?q=80&w=1920&auto=format&fit=crop',
            ],
            [
                'order' => 2,
                'image_path' => 'https://images.unsplash.com/photo-1552664730-d307ca884978?q=80&w=1920&auto=format&fit=crop',
            ],
            [
                'order' => 3,
                'image_path' => 'https://images.unsplash.com/photo-1441974231531-c6227db76b6e?q=80&w=1920&auto=format&fit=crop',
            ],
            [
                'order' => 4,
                'image_path' => 'https://images.unsplash.com/photo-1489824904134-891ab64532f1?q=80&w=1920&auto=format&fit=crop',
            ],
            [
                'order' => 5,
                'image_path' => 'https://images.unsplash.com/photo-1441974231531-c6227db76b6e?q=80&w=1920&auto=format&fit=crop',
            ],
        ];

        foreach ($homeContents as $contentData) {
            HomeContent::where('order', $contentData['order'])
                ->update(['image_path' => $contentData['image_path']]);
        }

        $this->command->info('Home content slider images berhasil diperbarui dengan gambar dari Unsplash.');
    }
}
