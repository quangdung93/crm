<?php

namespace App\View\Components;

use Illuminate\View\Component;

class UploadFile extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $type;
    public $title;
    public $name;
    public $image;
    public $width;

    public function __construct($type, $title, $name, $image, $width)
    {
        $this->type = $type;
        $this->title = $title;
        $this->name = $name;
        $this->image = $image;
        $this->width = $width;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.upload-file');
    }
}
