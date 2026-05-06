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

    protected $casts = [
        'highlights' => 'array',
        'highlights_bn' => 'array',
        'meta' => 'array',
        'meta_bn' => 'array',
        'active' => 'boolean',
    ];

    public function getTitleAttribute($value)
    {
        $locale = app()->getLocale();
        if ($locale == 'bn') {
            return $this->title_bn ?: $value;
        }
        return $value ?: $this->title_bn;
    }

    public function getSubtitleAttribute($value)
    {
        $locale = app()->getLocale();
        if ($locale == 'bn') {
            return $this->subtitle_bn ?: $value;
        }
        return $value ?: $this->subtitle_bn;
    }

    public function getDescriptionAttribute($value)
    {
        $locale = app()->getLocale();
        if ($locale == 'bn') {
            return $this->description_bn ?: $value;
        }
        return $value ?: $this->description_bn;
    }

    public function getContentAttribute($value)
    {
        $locale = app()->getLocale();
        if ($locale == 'bn') {
            return $this->content_bn ?: $value;
        }
        return $value ?: $this->content_bn;
    }

    public function getHighlightsAttribute($value)
    {
        $en = is_array($value) ? $value : json_decode($value, true);
        $bn = $this->highlights_bn; // This will use the cast value (array)

        $locale = app()->getLocale();
        if ($locale == 'bn') {
            return !empty($bn) ? $bn : $en;
        }
        return !empty($en) ? $en : $bn;
    }

    public function getMetaAttribute($value)
    {
        $en = is_array($value) ? $value : json_decode($value, true);
        $bn = $this->meta_bn; // This will use the cast value (array)

        $locale = app()->getLocale();
        
        // If it's an associative array, we might want to merge them for key-by-key fallback
        if ($locale == 'bn') {
            if (empty($bn)) return $en;
            if (empty($en)) return $bn;
            return array_merge($en, $bn); // BN values override EN values
        } else {
            if (empty($en)) return $bn;
            if (empty($bn)) return $en;
            return array_merge($bn, $en); // EN values override BN values
        }
    }

    public function addedBy()
    {
        return $this->belongsTo(User::class, 'addedby_id');
    }

    public function editedBy()
    {
        return $this->belongsTo(User::class, 'editedby_id');
    }
}
