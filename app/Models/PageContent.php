<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Traits\HasLocalization;

class PageContent extends Model
{
    use HasFactory, HasLocalization;

    protected $fillable = [
        'page_slug',
        'title',
        'title_bn',
        'subtitle',
        'subtitle_bn',
        'description',
        'description_bn',
        'content',
        'content_bn',
        'highlights',
        'highlights_bn',
        'meta',
        'meta_bn',
        'active',
        'addedby_id',
        'editedby_id',
    ];

    public function getTitleAttribute($value)
    {
        return $this->getLocalized('title');
    }

    public function getSubtitleAttribute($value)
    {
        return $this->getLocalized('subtitle');
    }

    public function getDescriptionAttribute($value)
    {
        return $this->getLocalized('description');
    }

    public function getContentAttribute($value)
    {
        return $this->getLocalized('content');
    }

    public function getHighlightsAttribute($value)
    {
        return $this->getLocalized('highlights');
    }

    public function getMetaAttribute($value)
    {
        return $this->getLocalized('meta');
    }

    protected $casts = [
        'highlights' => 'array',
        'highlights_bn' => 'array',
        'meta' => 'array',
        'meta_bn' => 'array',
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
