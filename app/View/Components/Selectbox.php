<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Selectbox extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $title;
    public $name;
    public $lists;
    public $value;
    public $display;
    public $selected;
    public $id;

    public function __construct($title, $name, $lists, $value, $display, $selected, $id = null)
    {
        $this->title = $title;
        $this->name = $name;
        $this->lists = $lists;
        $this->value = $value;
        $this->display = $display;
        $this->selected = $selected;
        $this->id = $id;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.selectbox');
    }
}
