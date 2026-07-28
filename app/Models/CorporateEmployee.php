<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * A staff member a company books rides for. Not an app account — just a saved
 * name/mobile so the booker doesn't retype it every trip.
 */
class CorporateEmployee extends Model
{
    protected $fillable = [
        'corporate_id', 'name', 'mobile', 'email',
        'department', 'employee_code', 'is_active',
    ];

    protected $casts = ['is_active' => 'boolean'];

    public function corporate()
    {
        return $this->belongsTo(Corporate::class);
    }

    /** Rides booked for this person by their company. */
    public function rides()
    {
        return RideRequest::where('corporate_id', $this->corporate_id)
            ->where('booked_for_mobile', $this->mobile);
    }
}
