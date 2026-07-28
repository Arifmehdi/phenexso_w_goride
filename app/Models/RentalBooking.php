<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RentalBooking extends Model
{
    protected $fillable = [
        'user_id', 'owner_type', 'rental_car_id',
        'with_return', 'pickup_date', 'pickup_time', 'return_date',
        'pickup_district', 'pickup_thana', 'dest_district', 'dest_thana',
        'contact_name', 'contact_phone',
        'total_price', 'status', 'note',
    ];

    protected $casts = [
        'with_return' => 'boolean',
        'pickup_date' => 'date',
        'return_date' => 'date',
        'total_price' => 'decimal:2',
    ];

    public const STATUSES = ['pending', 'confirmed', 'ongoing', 'completed', 'cancelled'];

    public function car()
    {
        return $this->belongsTo(RentalCar::class, 'rental_car_id');
    }

    /**
     * The customer who booked. Users / drivers / corporates are separate
     * tables with separate id spaces, so resolve via owner_type — never by
     * id alone.
     */
    public function owner()
    {
        return match ($this->owner_type) {
            'driver'    => Driver::find($this->user_id),
            'corporate' => Corporate::find($this->user_id),
            default     => User::find($this->user_id),
        };
    }

    /** Bookings still holding a car (blocks it from being double-booked). */
    public function scopeActive($q)
    {
        return $q->whereIn('status', ['pending', 'confirmed', 'ongoing']);
    }
}
