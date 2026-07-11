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
        'acceptance_rate',
        'total_offers',
        'accepted_offers',
        'cancelled_rides_count',
        'fcm_token',
        // Live location & availability (required for ride matching)
        'latitude',
        'longitude',
        'is_online',
        'last_location_update',
        // Verification / profile completion
        'father_name', 'mother_name', 'dob', 'blood_group', 'present_address', 'permanent_address',
        'emergency_contact_name', 'emergency_contact_phone',
        'profile_image', 'nid_front_image', 'nid_back_image', 'license_image', 'license_expiry',
        'vehicle_type', 'vehicle_model', 'vehicle_plate', 'vehicle_color', 'vehicle_year',
        'profile_completion', 'verification_status', 'rejection_reason',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function getRoleAttribute()
    {
        return 'driver';
    }

    /** Fields that count toward profile completion. */
    public static array $completionFields = [
        'father_name', 'mother_name', 'dob', 'blood_group', 'present_address', 'permanent_address',
        'emergency_contact_name', 'emergency_contact_phone',
        'nid', 'nid_front_image', 'nid_back_image',
        'license_no', 'license_image', 'license_expiry',
        'vehicle_type', 'vehicle_model', 'vehicle_plate', 'vehicle_color', 'vehicle_year',
        'profile_image',
    ];

    /** Recalculate profile_completion % and verification_status (safe if columns missing). */
    public function recalcCompletion(): void
    {
        if (!\Schema::hasColumn('drivers', 'profile_completion')) return;

        $total = count(self::$completionFields);
        $filled = 0;
        foreach (self::$completionFields as $f) {
            $v = $this->{$f} ?? null;
            if ($v !== null && trim((string) $v) !== '') $filled++;
        }
        $this->profile_completion = $total > 0 ? (int) round(($filled / $total) * 100) : 0;

        if (\Schema::hasColumn('drivers', 'verification_status')
            && !in_array($this->verification_status, ['verified', 'rejected'])) {
            $this->verification_status = $this->profile_completion >= 100 ? 'pending' : 'incomplete';
        }
        $this->saveQuietly();
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
