<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'type',
        'user_id',
        'impressions',
    ];

    // get the User who created the Post
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // get the likes of the Post
    public function likes()
    {
        return $this->hasMany(PostHasLikes::class, 'post_id');
    }

    // get the comments of the Post
    public function comments()
    {
        return $this->hasMany(PostHasComments::class, 'post_id');
    }

    public function medias()
    {
        return $this->hasMany(Media::class, 'post_id');
    }
}
