<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MainSection extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'video_link',
        'main_image',
    ];
}
