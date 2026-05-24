<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Traits\HasLocalization;

class FrontSlider extends Model
{
    use HasFactory, HasLocalization;

    public function getTitleAttribute($value)
    {
        return $this->getLocalized('title');
    }

    public function getDescriptionAttribute($value)
    {
        return $this->getLocalized('description');
    }

    public function fi()
    {
        return $this->featured_image ?: 'fi.jpg';
    }
}
