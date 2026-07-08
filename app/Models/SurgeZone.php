<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SurgeZone extends Model
{
    protected $fillable = [
        'name', 'center_lat', 'center_lng', 'radius_km',
        'multiplier', 'is_active', 'expires_at', 'created_by',
    ];

    protected $casts = [
        'is_active'   => 'boolean',
        'expires_at'  => 'datetime',
        'multiplier'  => 'float',
        'center_lat'  => 'float',
        'center_lng'  => 'float',
    ];

    /** Haversine distance in km from this zone's center to a point. */
    public function distanceTo(float $lat, float $lng): float
    {
        $earthRadius = 6371;
        $dLat = deg2rad($lat - $this->center_lat);
        $dLng = deg2rad($lng - $this->center_lng);
        $a = sin($dLat / 2) ** 2 + cos(deg2rad($this->center_lat)) * cos(deg2rad($lat)) * sin($dLng / 2) ** 2;
        return $earthRadius * 2 * atan2(sqrt($a), sqrt(1 - $a));
    }

    /** Find the highest active multiplier covering the given point (1.0 if none). */
    public static function multiplierFor(float $lat, float $lng): float
    {
        $best = 1.0;
        static::where('is_active', true)
            ->where(fn ($q) => $q->whereNull('expires_at')->orWhere('expires_at', '>', now()))
            ->get()
            ->each(function (self $zone) use ($lat, $lng, &$best) {
                if ($zone->distanceTo($lat, $lng) <= $zone->radius_km && $zone->multiplier > $best) {
                    $best = $zone->multiplier;
                }
            });
        return $best;
    }
}
