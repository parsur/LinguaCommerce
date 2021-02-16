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
    public function __construct($title,$formId,$description)
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
        return view('components.admin.page');
    }
}
