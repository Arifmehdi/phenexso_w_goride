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
        'actual_fare',
        'status',
        'cancelled_by',
        'cancellation_reason',
        'accepted_at',
        'started_at',
        'completed_at',
        'firebase_trip_id',
        'payment_status',
        'payment_method',
        'distance_km',
        'duration_minutes',
        'notes',
    ];

    protected $casts = [
        'accepted_at' => 'datetime',
        'started_at' => 'datetime',
        'completed_at' => 'datetime',
        'fare' => 'decimal:2',
        'actual_fare' => 'decimal:2',
        'distance_km' => 'decimal:2',
    ];

    /**
     * The user (rider) who created this ride request.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * The driver who was assigned to/accepted this ride.
     */
    public function driver()
    {
        return $this->belongsTo(Driver::class, 'driver_id');
    }

    /**
     * All ride offers made to drivers for this ride request.
     */
    public function offers()
    {
        return $this->hasMany(RideOffer::class);
    }

    /**
     * The accepted ride offer (if any).
     */
    public function acceptedOffer()
    {
        return $this->hasOne(RideOffer::class)->where('status', 'accepted');
    }

    /**
     * Only accepted offers (for history of which drivers were offered).
     */
    public function declinedOffers()
    {
        return $this->hasMany(RideOffer::class)->where('status', 'declined');
    }
}
