<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SosAlert extends Model
{
    protected $fillable = ['user_id', 'ride_request_id', 'latitude', 'longitude', 'status', 'notes', 'resolved_at'];
    protected $casts = ['resolved_at' => 'datetime'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function ride()
    {
        return $this->belongsTo(RideRequest::class, 'ride_request_id');
    }
}
