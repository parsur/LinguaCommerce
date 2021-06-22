<?php

namespace App\View\Components;

use Illuminate\View\Component;

class input extends Component
{
    public $key; // Id, specific key
    public $name; // Name of label
    public $type; // Default: text
    public $value; // Default: null
    public $class; // Class of div
    
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($key, $name, $type = 'text',
                                $value = null, $size = null, $class = null)
    {
        $this->key = $key;
        $this->name = $name;
        $this->type = $type;
        $this->value = $value;
        $this->class = $class;
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
