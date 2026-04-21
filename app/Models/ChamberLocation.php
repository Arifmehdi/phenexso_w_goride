<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChamberLocation extends Model
{
    use HasFactory;
    protected $fillable = [
        'doctor_id',
        'chamber_title',
        'schedules',
        'address',
    ];

    protected $casts = [
        'schedules' => 'array',
    ];

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }
}
