<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'file_name',
        'file_type',
        'priority',
        'thumbnail_image',
        'active',
        'addedby_id',
        'editedby_id',
    ];

    public function fi()
    {
        return $this->file_name ?: 'fi.jpg';
    }
}
