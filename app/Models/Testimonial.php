<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Traits\HasLocalization;

class Testimonial extends Model
{
    use HasFactory, HasLocalization;

    protected $fillable = [
        'name',
        'designation',
        'designation_bn',
        'company',
        'text_en',
        'text_bn',
        'rating',
        'image',
    ];

    public function getTextAttribute($value)
    {
        return $this->getLocalized('text');
    }

    public function getDesignationAttribute($value)
    {
        return $this->getLocalized('designation');
    }
}
