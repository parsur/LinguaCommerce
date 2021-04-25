<?php

namespace App\View\Components;

use Illuminate\View\Component;

class orderVerification extends Component
{
    public $class;
    public $message;
    
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($message, $class = null)
    {
        $this->class = $class;
        $this->message = $message;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return <<<'blade'
            <div class="alert alert-danger">
                {{ $slot }}
            </div>
        blade;
    }
}

