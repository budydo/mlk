<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class AdminUserSeeder extends Seeder
{
    public function run()
    {
        // Jika ada user dengan id 1, tetapkan sebagai admin
        $user = User::find(1);
        if ($user) {
            $user->role = 'admin';
            $user->save();
            $this->command->info("User id=1 set as admin");
            return;
        }

        // Jika tidak ada user, buat user admin contoh
        $admin = User::create([
            'name' => 'Administrator',
            'email' => 'admin@example.com',
            'password' => bcrypt('password123'),
            'role' => 'admin',
        ]);

        $this->command->info("Created admin: admin@example.com / password123");
    }
}
