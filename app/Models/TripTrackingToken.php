<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TripTrackingToken extends Model
{
    protected $fillable = ['ride_request_id', 'token', 'expires_at'];
    protected $casts = ['expires_at' => 'datetime'];
}
