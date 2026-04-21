<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogCategory extends Model
{
    use HasFactory;

    public function blogSubcategories(){
        return $this->hasMany(BlogSubCategory::class);
    }

    public function posts(){
        return $this->belongsToMany(BlogPost::class,'blog_category_posts','blog_category_id','blog_post_id');
    }

}
