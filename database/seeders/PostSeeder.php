<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\PostHasComments;
use App\Models\PostHasLikes;
use App\Models\User;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    public function run()
    {
        // Post 1: Food distribution event
        Post::create([
            'description' => 'Our NGO organized a food distribution program to support underprivileged families in the community.',
            'type' => 'media',
            'impressions' => 80,
            'user_id' => 1,
        ]);

        // Post 2: Tree plantation campaign
        Post::create([
            'description' => 'We successfully carried out a tree plantation campaign to promote a greener and healthier environment.',
            'type' => 'media',
            'impressions' => 150,
            'user_id' => 2,
        ]);

        // Post 3: Motivational message (no media)
        Post::create([
            'description' => 'Small efforts can bring big changes. Join hands with us to build a better future.',
            'type' => 'text',
            'impressions' => 45,
            'user_id' => 3,
        ]);

        // Post 4: Clothes distribution program
        Post::create([
            'description' => 'Our volunteers distributed warm clothes to needy families before the winter season.',
            'type' => 'media',
            'impressions' => 110,
            'user_id' => 4,
        ]);

        // Post 5: Education support program
        Post::create([
            'description' => 'We launched an education program to provide learning materials and support for children.',
            'type' => 'media',
            'impressions' => 95,
            'user_id' => 5,
        ]);
    }

    // function to get the Username of the User who created the Post
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // function to get the likes of the Post
    public function likes()
    {
        return $this->hasMany(PostHasLikes::class, 'post_id');
    }

    // function to get the comments of the Post
    public function comments()
    {
        return $this->hasMany(PostHasComments::class, 'post_id');
    }
}
