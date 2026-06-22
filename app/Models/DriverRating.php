<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DriverRating extends Model
{
    use HasFactory;

    protected $fillable = [
        'ride_request_id',
        'user_id',
        'driver_id',
        'rating',
        'review',
    ];

    public function rideRequest()
    {
        return $this->belongsTo(RideRequest::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function driver()
    {
        return $this->belongsTo(Driver::class);
    }
}
