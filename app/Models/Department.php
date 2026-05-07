<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cookie;

use App\Traits\HasLocalization;

class Department extends Model
{
    use HasFactory, HasLocalization;


    public function getNameAttribute($value)
    {
        return $this->getLocalized('name');
    }


    public function getExcerptAttribute($value)
    {
        return $this->getLocalized('excerpt');
    }

    public function fi()
    {
        return $this->image ? : 'fi.jpg';
    }


    public function doctors(){
        return $this->hasMany(Doctor::class);
   }
}
