<?php

namespace Database\Seeders;

use App\Models\Ngo;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NgoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Find the NGO user created in UserSeeder
        $ngoUser = User::where('email', 'ngo@ngo.com')->first();

        if ($ngoUser) {
            Ngo::create([
                'user_id' => $ngoUser->id,
                'mission' => 'Empowering communities through education and sustainability.',
                'description' => 'Sample NGO is dedicated to improving lives through education, environmental initiatives, and community support.',
                'location' => 'Kathmandu, Nepal',
                'photos' => json_encode([
                    '/images/ngo/sample1.jpg',
                    '/images/ngo/sample2.jpg',
                ]),
                'category' => 'Education',
                'subcategory' => 'Community Development',
            ]);
        }
    }
}
