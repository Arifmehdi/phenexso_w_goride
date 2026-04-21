<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'user_id',
        'note',
        'payment_method',
        'transaction_id',
        'previous_due_amount',
        'paid_amount',
        'due_amount',
        'payment_date',
        'payment_status',
        'addedby_id',
    ];
}