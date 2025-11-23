<?php

namespace Database\Seeders;

use App\Models\TeamMember;
use Illuminate\Database\Seeder;

class TeamMemberImageSeeder extends Seeder
{
    /**
     * Seed team member images dari Unsplash.
     */
    public function run(): void
    {
        $teamMembers = [
            [
                'name' => 'Ir. Muhammad Natsir Imran, ST., M.Si.',
                'photo' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?q=80&w=400&auto=format&fit=crop',
            ],
            [
                'name' => 'Bung Hendra',
                'photo' => 'https://images.unsplash.com/photo-1494790108377-be9c29b29330?q=80&w=400&auto=format&fit=crop',
            ],
            [
                'name' => 'Budi Santoso',
                'photo' => 'https://images.unsplash.com/photo-1527980965255-d3b416303d12?q=80&w=400&auto=format&fit=crop',
            ],
            [
                'name' => 'Lina Marlina',
                'photo' => 'https://images.unsplash.com/photo-1531123897727-8f129e1688ce?q=80&w=400&auto=format&fit=crop',
            ],
        ];

        foreach ($teamMembers as $memberData) {
            TeamMember::where('name', $memberData['name'])
                ->update(['photo' => $memberData['photo']]);
        }

        $this->command->info('Team member images berhasil diperbarui dengan gambar dari Unsplash.');
    }
}
