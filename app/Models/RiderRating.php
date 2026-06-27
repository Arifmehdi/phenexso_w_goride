<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RiderRating extends Model
{
    protected $fillable = ['ride_request_id', 'driver_id', 'rider_id', 'rating', 'review', 'tags'];
    protected $casts = ['tags' => 'array'];
}
