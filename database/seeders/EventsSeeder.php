<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EventsSeeder extends Seeder
{
    public function run()
    {
        DB::table('events')->insert([
            [
                'title' => 'Tech Conference 2025',
                'description' => 'A conference bringing together innovators and leaders in technology.',
                'location' => 'Kathmandu, Nepal',
                'type' => '1', // offline
                'start_date' => Carbon::create(2025, 10, 5, 9, 0, 0),
                'end_date' => Carbon::create(2025, 10, 5, 17, 0, 0),
                'cover_image_path_name' => 'tech_conf_2025.jpg',
                'capacity' => '500',
                'is_volunteers_required' => true,
                'user_id' => 1, // make sure this user exists
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Online Coding Bootcamp',
                'description' => 'A 7-day online bootcamp covering full stack development.',
                'location' => 'Zoom',
                'type' => '0', // online
                'start_date' => Carbon::create(2025, 11, 1, 10, 0, 0),
                'end_date' => Carbon::create(2025, 11, 7, 18, 0, 0),
                'cover_image_path_name' => 'bootcamp_banner.png',
                'capacity' => '200',
                'is_volunteers_required' => false,
                'user_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Charity Fundraiser Gala',
                'description' => 'Fundraising event for local NGOs working in education and health.',
                'location' => 'Biratnagar, Nepal',
                'type' => '1', // offline
                'start_date' => Carbon::create(2025, 12, 15, 18, 30, 0),
                'end_date' => Carbon::create(2025, 12, 15, 22, 0, 0),
                'cover_image_path_name' => 'charity_gala.jpg',
                'capacity' => '300',
                'is_volunteers_required' => true,
                'user_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
