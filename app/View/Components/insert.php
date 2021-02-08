<?php

namespace App\View\Components;

use Illuminate\View\Component;

class insert extends Component
{
    public $size;
    public $formId;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($size,$formId)
    {
        $this->size = $size;
        $this->formId = $formId;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.admin.insert');
    }
}
