<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;

    protected $fillable = [
        'vehicle_type',
        'plate_number',
        'capacity',
        'status',
        'owner_id',
    ];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function drivers()
    {
        return $this->hasMany(User::class, 'vehicle_id');
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

}
