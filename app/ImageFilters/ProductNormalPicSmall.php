<?php

namespace App\ImageFilters;

use Intervention\Image\Image;
use Intervention\Image\Filters\FilterInterface;

class ProductNormalPicSmall implements FilterInterface
{
    public function applyFilter(Image $image)
    {
        return $image->resize(210, 210);
    }
}

