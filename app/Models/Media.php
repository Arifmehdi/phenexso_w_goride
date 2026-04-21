<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    use HasFactory;

    protected $guarded = [];

    const SUPPORTED_IMAGE_TYPES =  ['jpg','png','svg','gip','jpeg','pjpeg','gif','webp','ico'];

    const SUPPORTED_VIDEO_TYPES =  ['mp4','mov','wvm','mkv','avi','flv','mkv','swf','wevm','avchd','f4v'];

}
