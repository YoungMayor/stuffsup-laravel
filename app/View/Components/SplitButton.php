<?php

namespace App\View\Components;

use Illuminate\View\Component;

class SplitButton extends Component
{
    public $icon;
    public $label;
    public $link;
    public $type;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($icon, $label, $link, $type = "success")
    {
        $this->icon = $icon;
        $this->label = $label;
        $this->link = $link;
        $this->type = $type;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.split-button');
    }
}
