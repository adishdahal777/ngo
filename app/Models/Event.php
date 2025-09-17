<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'location',
        'type',
        'start_date',
        'end_date',
        'cover_image_path_name',
        'capacity',
        'is_volunteers_required',
        'user_id',
    ];
}
