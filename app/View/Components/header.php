<?php

namespace App\View\Components;

use Illuminate\View\Component;

class header extends Component
{
    public $pageName; 
    public $buttonValue; // Default: null
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($pageName, $buttonValue = null)
    {
        $this->pageName = $pageName;
        $this->buttonValue = $buttonValue;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.header');
    }
}
