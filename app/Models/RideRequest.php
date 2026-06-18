<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RideRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'driver_id',
        'ride_type',
        'pickup_latitude',
        'pickup_longitude',
        'pickup_address',
        'destination_latitude',
        'destination_longitude',
        'destination_address',
        'fare',
        'status',
        'accepted_at',
        'started_at',
        'completed_at',
        'firebase_trip_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function driver()
    {
        return $this->belongsTo(Driver::class, 'driver_id');
    }
}
