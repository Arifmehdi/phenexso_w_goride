<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'recipient_type',
        'title',
        'message',
        'ip_address',
        'all_show',
        'is_read',
        'read_at',
        'type',
        'data',
    ];

    protected $casts = [
        'data'     => 'array',
        'all_show' => 'boolean',
        'is_read'  => 'boolean',
        'read_at'  => 'datetime',
    ];
}
