<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RideOffer extends Model
{
    use HasFactory;

    protected $fillable = [
        'ride_request_id',
        'driver_id',
        'status',
        'offered_at',
        'responded_at',
        'priority_order',
    ];

    protected $casts = [
        'offered_at' => 'datetime',
        'responded_at' => 'datetime',
    ];

    /**
     * The ride request this offer belongs to.
     */
    public function rideRequest()
    {
        return $this->belongsTo(RideRequest::class);
    }

    /**
     * The driver who received this offer.
     */
    public function driver()
    {
        return $this->belongsTo(Driver::class);
    }
}
