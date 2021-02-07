<?php

namespace App\View\Components;

use Illuminate\View\Component;

class urlAddress extends Component
{
    public $route;
    public $fontAwsome;
    public $text;
    
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($title, $description, $fontAwesome)
    {
        $this->route = $route;
        $this->fontAwesome = $fontAwesome;
        $this->text = $text;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.urlAddress');
    }
}
