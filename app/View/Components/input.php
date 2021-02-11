<?php

namespace App\View\Components;

use Illuminate\View\Component;

class input extends Component
{
    public $name;
    public $id;
    public $placeholder;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($name,$id,$placeholder)
    {
        $this->name = $name;
        $this->id = $id;
        $this->placeholder = $placeholder;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.input');
    }
}
