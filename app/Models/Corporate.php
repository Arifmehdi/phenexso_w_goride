<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Corporate extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'company_name',
        'email',
        'mobile',
        'password',
        'address',
        'status',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function getRoleAttribute()
    {
        return 'corporate';
    }

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
