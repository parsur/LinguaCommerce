<?php

namespace App\View\Components;

use Illuminate\View\Component;

class page extends Component
{
    public $title;
    public $description;
    public $formId;
    
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($title,$description,$formId = null)
    {
        $this->title = $title;
        $this->formId = $formId;
        $this->description = $description;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.page');
    }
}
