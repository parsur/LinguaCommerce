<?php

namespace App\View\Components;

use Illuminate\View\Component;

class textarea extends Component
{
    public $key;
    public $name;
    public $value;
    public $rows;
    
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($key, $name, $value = null, $rows = 3)
    {
        $this->key = $key;
        $this->name = $name;
        $this->value = $value;
        $this->rows = $rows;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.textarea');
    }
}
