<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RentalCar extends Model
{
    protected $fillable = [
        'name', 'type', 'image', 'seats', 'transmission', 'fuel',
        'plate_number', 'price_one_way', 'price_with_return',
        'features', 'is_available',
    ];

    protected $casts = [
        'price_one_way'     => 'decimal:2',
        'price_with_return' => 'decimal:2',
        'is_available'      => 'boolean',
        'seats'             => 'integer',
    ];

    public function bookings()
    {
        return $this->hasMany(RentalBooking::class);
    }

    /** Price for the trip type the customer picked. */
    public function priceFor(bool $withReturn): float
    {
        return (float) ($withReturn ? $this->price_with_return : $this->price_one_way);
    }
}
