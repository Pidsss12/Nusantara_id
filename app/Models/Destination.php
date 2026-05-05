<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Destination extends Model
{
    use HasFactory;

    protected $fillable = [
        'province_id',
        'name',
        'slug',
        'description',
        'category',
        'price',
        'quota_per_day',
        'location',
        'latitude',
        'longitude',
        'photo',
        'rating',
        'bookings_count',
        'status',
    ];

    public function province()
    {
        return $this->belongsTo(Province::class);
    }

    public function packages()
    {
        return $this->hasMany(Package::class);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
