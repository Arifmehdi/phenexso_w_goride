<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cookie;

class Department extends Model
{
    use HasFactory;


    public function getNameAttribute($value)
    {
        // $locale = Cookie::get('locale') ?: config('app.locale');
        $locale = session('locale') ?: config('app.locale');

        return $this->attributes['name_'. $locale];
    }


    public function getExcerptAttribute($value)
    {
        // $locale = Cookie::get('locale') ?: config('app.locale');
        $locale = session('locale') ?: config('app.locale');

        return $this->attributes['excerpt_'. $locale];
    }

    public function fi()
    {
        return $this->image ? : 'fi.jpg';
    }


    public function doctors(){
        return $this->hasMany(Doctor::class);
   }
}
