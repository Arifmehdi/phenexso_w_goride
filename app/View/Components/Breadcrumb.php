<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Breadcrumb extends Component
{
    public $title;
    public $pageName;
    public $bgImage;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($title = 'News Details', $pageName = null, $bgImage = 'img/bg/9.jpg')
    {
        $this->title = $title;
        $this->pageName = $pageName;
        $this->bgImage = $bgImage;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.breadcrumb');
    }
}