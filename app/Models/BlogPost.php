<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Traits\HasLocalization;

class BlogPost extends Model
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

    public function getExcerptAttribute($value)
    {
        return $this->getLocalized('excerpt');
    }

    public function category(){
        return $this->belongsTo(BlogCategory::class, 'category_id');
    }


    public function addedBy(){
        return $this->belongsTo(User::class, 'addedby_id');
    }

    public function user(){
        return $this->belongsTo(User::class);
    }


    public function fi()
    {
        return $this->feature_image ?: 'fi.jpg';
    }




}
