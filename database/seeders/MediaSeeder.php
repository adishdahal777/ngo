<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Media;

class MediaSeeder extends Seeder
{
    public function run()
    {
        // Media for Post 1 (NGO food distribution event)
        Media::create([
            'media_type' => 'image',
            'media_path_name' => 'images/posts/food_distribution.jpg',
            'post_id' => 1,
        ]);

        // Media for Post 2 (Tree plantation campaign)
        Media::create([
            'media_type' => 'image',
            'media_path_name' => 'images/posts/tree_plantation1.jpg',
            'post_id' => 2,
        ]);

        Media::create([
            'media_type' => 'image',
            'media_path_name' => 'images/posts/tree_plantation2.jpg',
            'post_id' => 2,
        ]);

        // Media for Post 3 (Clothes distribution event)
        Media::create([
            'media_type' => 'image',
            'media_path_name' => 'images/posts/cloth_distribution.jpg',
            'post_id' => 4,
        ]);

        // Media for Post 4 (Awareness campaign)
        Media::create([
            'media_type' => 'image',
            'media_path_name' => 'images/posts/awareness_campaign.jpg',
            'post_id' => 2,

        ]);

        // Media for Post 5 (NGO education program)
        Media::create([
            'media_type' => 'image',
            'media_path_name' => 'images/posts/education_program1.jpg',
            'post_id' => 5,
        ]);

        Media::create([
            'media_type' => 'image',
            'media_path_name' => 'images/posts/education_program2.jpg',
            'post_id' => 5,
        ]);
    }
}
