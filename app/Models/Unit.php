<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    use HasFactory;

    protected $fillable = [
        'name_en',
        'name_bn',
        'active',
        'addedby_id',
        'editedby_id',
    ];
}
