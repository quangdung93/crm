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
    public $title;
    public $width;
    public $height;
    public $image;

    public function __construct($title, $width, $height, $image)
    {
        $this->title = $title;
        $this->width = $width;
        $this->height = $height;
        $this->image = $image;
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
