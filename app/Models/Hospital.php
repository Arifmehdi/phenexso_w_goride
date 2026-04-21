<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cookie;

class Hospital extends Model
{
    use HasFactory;

    public function getNameAttribute($value)
    {
         // $locale = Cookie::get('locale') ?: config('app.locale');
         $locale = session('locale') ?: config('app.locale');

        return $this->attributes['name_'. $locale];
    }

    public function getDescriptionAttribute($value)
    {
         // $locale = Cookie::get('locale') ?: config('app.locale');
         $locale = session('locale') ?: config('app.locale');

        return $this->attributes['description_'. $locale];
    }

    public function getAddressAttribute($value)
    {
         // $locale = Cookie::get('locale') ?: config('app.locale');
         $locale = session('locale') ?: config('app.locale');

        return $this->attributes['address_'. $locale];
    }



    public function fi()
    {
        return $this->image ? : 'fi.jpg';
    }

    public function doctors(){
        return $this->belongsToMany(Doctor::class,'doctor_hospitals')->withPivot(['schedule','fee']);
    }

    public function hospital_contacts(){
      return  array_map('trim', explode(',', $this->hospital_contacts));
    }

    public function visits(){
        return $this->hasMany(Visit::class);
    }

}
