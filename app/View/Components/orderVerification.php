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
            <section class="{{ $class ?? null }}">
                <div class="sub-section text"><h2>{{ $message }}</h2></div>
                <div class="sub-section redirect"><h3>برای بازگشت به سایت <a href="/">کلیک</a> کنید</h3></div>
            </section>
        blade;
    }
}

