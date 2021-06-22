<?php

namespace App\View\Components;

use Illuminate\View\Component;

class urlAddress extends Component
{
    public $text;
    public $route;
    public $fontAwesome;
    
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($text, $route, $fontAwesome)
    {
        $this->text = $text;
        $this->route = $route;
        $this->fontAwesome = $fontAwesome;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return <<<'blade'
            <li class="nav-item">
                <a href="{{ $route }}" class="nav-link">
                    <i class="{{ $fontAwesome }}"></i>
                    <p class="mr-1">{{ $text }}</p>
                </a>
            </li>
        blade;
    }
}

