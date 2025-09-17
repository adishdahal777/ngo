<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable, HasFactory;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id',
        'owner_id',
        'verified',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'verified' => 'boolean',
    ];


    public function favoriteNgos()
    {
        return $this->belongsToMany(Ngo::class, 'user_ngo_favorites', 'user_id', 'ngo_id')->withTimestamps();
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function ownedNgos()
    {
        return $this->hasMany(User::class, 'owner_id')->where('role_id', 1);
    }

    public function ngo()
    {
        return $this->hasOne(Ngo::class, 'user_id', 'id');
    }

    public function isAdmin()
    {
        return $this->role_id === 0;
    }

    public function isNgo()
    {
        return $this->role_id === 1;
    }

    public function isPeople()
    {
        return $this->role_id === 2;
    }
}
