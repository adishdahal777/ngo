<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Ngo extends Model
{
    use Notifiable;

    protected $fillable = [
        'name',
        'mission',
        'description',
        'location',
        'logo',
        'category',
        'subcategory',
    ];

    protected $casts = [
        'photos' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function favoritedByUsers()
    {
        return $this->belongsToMany(User::class, 'user_ngo_favorites', 'ngo_id', 'user_id')->withTimestamps();
    }
}
