<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RidePool extends Model
{
    protected $fillable = ['ride_request_id', 'max_passengers', 'current_passengers', 'is_open'];
    protected $casts = ['is_open' => 'boolean'];

    public function rideRequest()
    {
        return $this->belongsTo(RideRequest::class);
    }

    public function passengers()
    {
        return $this->hasMany(RidePoolPassenger::class);
    }
}
