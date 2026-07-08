<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RidePoolPassenger extends Model
{
    protected $fillable = [
        'ride_pool_id', 'user_id', 'ride_request_id',
        'pickup_lat', 'pickup_lng', 'dest_lat', 'dest_lng',
    ];

    protected $casts = [
        'pickup_lat' => 'float', 'pickup_lng' => 'float',
        'dest_lat'   => 'float', 'dest_lng'   => 'float',
    ];

    public function pool()
    {
        return $this->belongsTo(RidePool::class, 'ride_pool_id');
    }
}
