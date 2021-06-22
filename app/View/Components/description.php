<?php

namespace App\View\Components;

use Illuminate\View\Component;

class description extends Component
{
    public $title;
    public $model;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($title,$model)
    {
        $this->title = $title;
        $this->model = $model;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.description');
    }
}
