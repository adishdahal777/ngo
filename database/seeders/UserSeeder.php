<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::factory()->admin()->create([
            'name' => 'Admin User',
            'email' => 'admin@ngo.com',
        ]);

        $people = User::factory()->people()->count(5)->create();

        $owner = $people->random();

        User::factory()->ngo()->create([
            'name' => 'Sample NGO',
            'email' => 'ngo@ngo.com',
            'owner_id' => $owner->id,
        ]);
    }
}
