<?php

namespace App\View\Components;

use Illuminate\View\Component;

class table extends Component
{
    public $table;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($table)
    {
        $this->table = $table;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return <<<'blade'
            {{-- Table --}}
            {!! $table->table(['class' => 'table table-bordered table-striped w-100 nowrap text-center'], false) !!}
        blade;
    }
}
