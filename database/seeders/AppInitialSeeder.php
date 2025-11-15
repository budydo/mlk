<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Service;
use App\Models\Project;
use App\Models\TeamMember;
use App\Models\HomeContent;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class AppInitialSeeder extends Seeder
{
    /**
     * Seed initial application data for testing.
     */
    public function run(): void
    {
        // Buat akun demo: admin, editor, viewer (gunakan updateOrCreate untuk menghindari duplikasi)
        User::updateOrCreate(
            ['email' => 'admin@example.com'],
            ['name' => 'Admin', 'password' => bcrypt('password'), 'role' => 'admin']
        );

        User::updateOrCreate(
            ['email' => 'editor@example.com'],
            ['name' => 'Editor', 'password' => bcrypt('password'), 'role' => 'editor']
        );

        User::updateOrCreate(
            ['email' => 'viewer@example.com'],
            ['name' => 'Viewer', 'password' => bcrypt('password'), 'role' => 'viewer']
        );

        // Tambahkan beberapa layanan contoh (gunakan updateOrCreate)
        $services = [
            ['title'=>'AMDAL & Kajian Dampak','slug'=>'amdal-kajian-dampak','excerpt'=>'Kajian dampak lingkungan komprehensif.','description'=>'Deskripsi layanan AMDAL dan manfaatnya.','icon'=>'/images/icons/amdal.svg'],
            ['title'=>'Restorasi Lahan','slug'=>'restorasi-lahan','excerpt'=>'Program revegetasi dan restorasi ekosistem.','description'=>'Deskripsi restorasi lahan.','icon'=>'/images/icons/restorasi.svg'],
        ];
        foreach($services as $s) { 
            Service::updateOrCreate(['slug' => $s['slug']], $s);
        }

        // Tambahkan beberapa proyek contoh (gunakan updateOrCreate)
        Project::updateOrCreate(
            ['slug'=>'restorasi-pesisir-x'],
            ['title'=>'Restorasi Pesisir — Kabupaten X','cover_image'=>'/images/projects/pesisir.jpg','excerpt'=>'Revegetasi hutan mangrove.', 'description'=>'Deskripsi proyek restorasi pesisir.']
        );
        Project::updateOrCreate(
            ['slug'=>'amdal-pelabuhan'],
            ['title'=>'AMDAL Pembangunan Pelabuhan','cover_image'=>'/images/projects/pelabuhan.jpg','excerpt'=>'Analisis dampak & mitigasi.', 'description'=>'Deskripsi proyek AMDAL.']
        );

        // Tambahkan anggota tim contoh (gunakan updateOrCreate)
        TeamMember::updateOrCreate(
            ['name'=>'Dr. Andi Wijaya'],
            ['role'=>'Kepala Tim','photo'=>'/images/team/andi.jpg','bio'=>'Ahli lingkungan dengan pengalaman 15 tahun.']
        );
        TeamMember::updateOrCreate(
            ['name'=>'Siti Rahma'],
            ['role'=>'Spesialis Sosial','photo'=>'/images/team/siti.jpg','bio'=>'Spesialis kajian sosial dan keterlibatan masyarakat.']
        );

        // Konten home akan diisi oleh HomeContentSeeder
        $this->command->info('Seeder awal selesai: user, layanan, proyek, dan tim selesai ditambahkan.');
    }
}
