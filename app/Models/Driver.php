<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Driver extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'mobile',
        'password',
        'license_no',
        'nid',
        'address',
        'status',
        'user_id',
        'average_rating',
        'total_ratings',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function getRoleAttribute()
    {
        return 'driver';
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    // ── Rating Relationships ──

    public function ratings()
    {
        return $this->hasMany(DriverRating::class);
    }

    public function rideRequests()
    {
        return $this->hasMany(RideRequest::class, 'driver_id');
    }

    /**
     * Recalculate the average rating for this driver.
     */
    public function recalculateRating()
    {
        $this->average_rating = $this->ratings()->avg('rating') ?? 0;
        $this->total_ratings = $this->ratings()->count();
        $this->save();
    }
}
