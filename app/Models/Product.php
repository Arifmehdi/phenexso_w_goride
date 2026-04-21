<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\OrderItem;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'click_count',
        'name_en',
        'name_bn',
        'sku',
        'stock',
        'slug',
        'excerpt_en',
        'excerpt_bn',
        'description_en',
        'description_bn',
        'featured_image',
        'price',
        'discount',
        'discount_price',
        'final_price',
        'selling_price',
        'purchase_price',
        'unit',
        'tags',
        'active',
        'feature',
        'editor',
        'addedby_id',
        'editedby_id',
        'seller_id',
        'rider_id',
    ];


    public function fi()
    {
        return $this->featured_image ?: 'not_found.png';
    }

    public function addedBy()
    {
        return $this->belongsTo(User::class, 'addedby_id');
    }

    public function seller()
    {
        return $this->belongsTo(User::class, 'seller_id');
    }

    public function rider()
    {
        return $this->belongsTo(User::class, 'rider_id');
    }

    public function categories()
    {
        return $this->belongsToMany(ProductCategory::class, 'product_cats', 'product_id', 'product_category_id');
    }



    public function cart()
    {
        return $this->hasOne(Cart::class);
    }


    public function items()
    {
       return $this->hasMany(OrderItem::class, 'product_id');
    }


    
    public function media()
    {
        return $this->hasMany(Media::class);
    }

    public function reviews(){
        return $this->hasMany(ProductReview::class);
    }

    // Get average rating
    public function averageRating()
    {
        return $this->reviews()->avg('rating') ?? 0;
    }

 

   
}