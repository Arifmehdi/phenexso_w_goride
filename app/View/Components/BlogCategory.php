<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Models\BlogCategory as BlogCategoryModel;

class BlogCategory extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $data['categories'] = BlogCategoryModel::whereActive(true)->orderBy('name')->get();
        return view('components.blog-category', $data);
    }
}
