<?php

namespace App\Models;

use Carbon\Carbon;
use DateTimeZone;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = [
        'website_logo',
        'address',
        'address-icon',
        'contact_phone',
        'contact_email',
        'contact_icon',
        'service_title',
        'service_description',
        'work_from',
        'work_to',
        'work_icon',
        'blog_title',
        'blog_description',
        'contact_us_title',
        'contact_us_subtitle',
        'contact_us_description',
        'footer_title',
    ];

    /**
     * ? To Casting ( From - To ) As Time
     */
    protected $casts = [
        'work_from' => 'time',
        'work_to' => 'time',
    ];

    /**
     * @param $value
     * @return bool|DateTimeZone|int|string|null
     * ? Accessor Attribute To Get ( Work From ) As H:i
     */
    public function getWorkFromAttribute($value)
    {
        return Carbon::createFromFormat('H:i', $value)->time;
    }

    /**
     * @param $value
     * @return bool|DateTimeZone|int|string|null
     * ? Accessor Attribute To Get ( Work To ) As H:i
     */
    public function getWorkToAttribute($value)
    {
        return Carbon::createFromFormat('H:i', $value)->time;
    }
}
