<?php

namespace App\View\Components;

use Illuminate\View\Component;

class page extends Component
{
    public $title; // Title of page
    public $description; // Description of title
    public $formId; // Form id | default: null
    
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($title,$description,$formId = null)
    {
        $this->title = $title;
        $this->description = $description;
        $this->formId = $formId;
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
