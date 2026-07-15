<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    protected $fillable = ['user_id', 'owner_type', 'balance'];
    protected $casts = ['balance' => 'decimal:2'];

    /**
     * Transactions belonging to this exact wallet — matched on BOTH
     * user_id and owner_type, since a User #3 and a Driver #3 are
     * completely different entities that must never share transactions.
     */
    public function transactions()
    {
        return $this->hasMany(WalletTransaction::class, 'user_id', 'user_id')
            ->where('wallet_transactions.owner_type', $this->owner_type);
    }
}
