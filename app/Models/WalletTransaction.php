<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WalletTransaction extends Model
{
    protected $fillable = ['user_id', 'owner_type', 'type', 'amount', 'description', 'reference', 'balance_after'];
    protected $casts = ['amount' => 'decimal:2', 'balance_after' => 'decimal:2'];
}
