<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DriverPayout extends Model
{
    protected $fillable = [
        'driver_id', 'period_from', 'period_to', 'gross_earnings', 'commission',
        'net_amount', 'status', 'payout_method', 'reference', 'paid_at', 'processed_by',
    ];

    protected $casts = [
        'period_from'    => 'date',
        'period_to'      => 'date',
        'paid_at'        => 'datetime',
        'gross_earnings' => 'float',
        'commission'     => 'float',
        'net_amount'     => 'float',
    ];

    public function driver()
    {
        return $this->belongsTo(Driver::class);
    }
}
