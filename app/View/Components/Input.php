<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Input extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $type;
    public $title;
    public $name;
    public $value;
    public $id;
    public $class;
    public $required;

    public function __construct($type, $title, $name, $value, $id = '', $class = '', $required = false)
    {
        $this->type = $type;
        $this->title = $title;
        $this->name = $name;
        $this->value = $value;
        $this->id = $id;
        $this->class = $class;
        $this->required = $required;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.input');
    }
}
