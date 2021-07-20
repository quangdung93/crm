<?php

namespace App\View\Components;

use Illuminate\View\Component;

class SwitchBox extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $type;
    public $title;
    public $name;
    public $checked;

    public function __construct($type, $title, $name, $checked)
    {
        $this->type = $type;
        $this->title = $title;
        $this->name = $name;
        $this->checked = $checked;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.switch-box');
    }
}
