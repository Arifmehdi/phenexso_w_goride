<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliveryLocation extends Model
{
    use HasFactory;
    protected $table = 'delivery_locations';

    protected $fillable = [
        'user_id',
        'name',
        'email',
        'mobile',
        'address_title',
    ];
}
