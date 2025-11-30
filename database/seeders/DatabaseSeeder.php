<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\AppInitialSeeder;
use Database\Seeders\PostSeeder;


class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        // Panggil seeder aplikasi yang menyiapkan data awal untuk pengujian
        $this->call([
            AppInitialSeeder::class,
            HomeContentSeeder::class,
            PostSeeder::class,
            FeaturedProjectSeeder::class,
            CompleteServiceSeeder::class,
            ServiceImageSeeder::class,
            // ProjectImageSeeder::class,
            HomeContentImageSeeder::class,
            TeamMemberImageSeeder::class,
            ContactMessageSeeder::class,
        ]);
    }
}
