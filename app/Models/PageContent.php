<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PageContent extends Model
{
    use HasFactory;

    protected $fillable = [
        'page_slug',
        'title',
        'subtitle',
        'description',
        'content',
        'highlights',
        'meta',
        'active',
        'addedby_id',
        'editedby_id',
    ];

    protected $casts = [
        'highlights' => 'array',
        'meta' => 'array',
        'active' => 'boolean',
    ];

    public function addedBy()
    {
        return $this->belongsTo(User::class, 'addedby_id');
    }

    public function editedBy()
    {
        return $this->belongsTo(User::class, 'editedby_id');
    }
}
