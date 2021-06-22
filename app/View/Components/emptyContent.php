<?php

namespace App\View\Components;

use Illuminate\View\Component;

class empty extends Component
{
    public $title;
    public $text;
    public $route;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($title, $text, $route)
    {
        $this->title = $title;
        $this->text = $text;
        $this->route = $route;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.emptyContent');
    }
}
