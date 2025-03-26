<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Kpi extends Component
{
    public $title, $value, $color, $icon, $route;

    public function __construct($title, $value, $color, $icon, $route = null)
    {
        $this->title = $title;
        $this->value = $value;
        $this->color = $color;
        $this->icon = $icon;
        $this->route = $route;
    }

    public function render()
    {
        return view('components.kpi');
    }
}
