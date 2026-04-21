<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Cookie;

class Doctor extends Model
{
    use HasFactory;


    public function getNameAttribute($value)
    {
        // $locale = Cookie::get('locale') ?: config('app.locale');
        $locale = session('locale') ?: config('app.locale');

        return $this->attributes['name_'. $locale];
    }

    public function getDesignationAttribute($value)
    {
        // $locale = Cookie::get('locale') ?: config('app.locale');
        $locale = session('locale') ?: config('app.locale');

        return $this->attributes['designation_'. $locale];
    }

    public function getExcerptAttribute($value)
    {
        // $locale = Cookie::get('locale') ?: config('app.locale');
        $locale = session('locale') ?: config('app.locale');

        return $this->attributes['excerpt_'. $locale];
    }

    public function getDescriptionAttribute($value)
    {
         // $locale = Cookie::get('locale') ?: config('app.locale');
         $locale = session('locale') ?: config('app.locale');

        return $this->attributes['description_'. $locale];
    }


    public function fi()
    {
        return $this->doctor_image ? : 'doctor_profile.jpg';
    }

   public function hospitals() {
        return $this->belongsToMany(
            Hospital::class,       // Related model
            'doctor_hospitals',    // Pivot table name
            'doctor_id',           // Foreign key on pivot table pointing to this model
            'hospital_id'          // Foreign key on pivot table pointing to related model
        )->withPivot('id');       // optional, pivot column(s) if needed
    }



    public function department(){
         return $this->belongsTo(BisesoggoCategory::class, 'department_id');
    }

    public function chambers(){
         return $this->hasMany(ChamberLocation::class);
    }

}
