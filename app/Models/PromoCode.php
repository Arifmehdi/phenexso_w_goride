<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PromoCode extends Model
{
    protected $fillable = ['code', 'type', 'value', 'min_fare', 'max_discount', 'max_uses', 'used_count', 'expires_at', 'is_active'];
    protected $casts = ['expires_at' => 'datetime', 'is_active' => 'boolean', 'value' => 'decimal:2'];
}
