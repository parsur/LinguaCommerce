<?php

namespace App\View\Components;

use Illuminate\View\Component;

class textarea extends Component
{
    public $key; // id, name
    public $placeholder; // label, placeholder
    public $value; // value | default: null
    public $rows; // rows | default: 3
    public $class; // class
    
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($key, $placeholder, 
                                $rows = 3, $value = null, $class = null)
    {
        $this->key = $key;
        $this->placeholder = $placeholder;
        $this->value = $value;
        $this->rows = $rows;
        $this->class = $class;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return <<<'blade'
            <div class="{{ $class ?? null }}">
                <label for="{{ $key }}">{{ $placeholder }}:</label>

                <textarea name="{{ $key }}" id="{{ $key }}" rows="{{ $rows ?? 3 }}" class="form-control" 
                    placeholder="{{ $placeholder }}">{{ $value ?? null }}</textarea>
            </div>
        blade;
    }
}
