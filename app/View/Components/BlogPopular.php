<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Models\BlogPost;

class BlogPopular extends Component
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
        $data['popular_posts'] = BlogPost::where('active', true)
                        ->where('status', 'published')
                        ->orderBy('view_count', 'desc')
                        ->take(12)
                        ->get();
        return view('components.blog-popular', $data);
    }
}
