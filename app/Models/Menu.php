<?php

namespace App\Models;


use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
   

    public function addedBy()
    {
        return $this->belongsTo(User::class, 'addedby_id');
    }

    public function pages()
    {
        return $this->belongsToMany(Page::class, 'menu_pages');
    }

    public function latestPages()
    {
        
        return $this->pages()->orderBy('drag_id')->whereActive(true)->latest()->get();
    }
    
}