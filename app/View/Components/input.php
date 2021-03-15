<?php

namespace App\View\Components;

use Illuminate\View\Component;

class input extends Component
{
    public $key;
    public $name;
    public $type;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($key, $name, $type = 'text')
    {
        $this->key = $key;
        $this->name = $name;
        $this->type = $type;
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
