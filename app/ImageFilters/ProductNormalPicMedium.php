<?php

namespace App\ImageFilters;

use Intervention\Image\Image;
use Intervention\Image\Filters\FilterInterface;

class ProductNormalPicMedium implements FilterInterface
{
    public function applyFilter(Image $image)
    {
        return $image->resize(null, 400, function ($constraint) {
            $constraint->aspectRatio();
        });
    }
}
