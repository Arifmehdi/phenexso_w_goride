<?php

namespace App\ImageFilters;

use Intervention\Image\Image;
use Intervention\Image\Filters\FilterInterface;

class FeatureImageForHome implements FilterInterface
{
    public function applyFilter(Image $image)
    {
        $image->fit(360, 240);
        return  $image->insert('img/tmm5.png');
    }
}