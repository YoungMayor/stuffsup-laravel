<?php

namespace App\View\Components;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\View\Component;

class SideNavItem extends Component
{
    /**
     * The Menu Details
     *
     * @var array
     */
    public $menu;

    /**
     * The item's anchor reference
     * This would be set by the constructor
     *
     * @var string
     */
    public $href;

    /**
     * A class that would be added to the item depending on whether the giving
     * route matches the currently opened route, if so active is added
     * This would be set by the constructor
     *
     * @var string
     */
    public $active_class;

    public $should_render = true;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($menu)
    {
        $this->menu = $menu;
        if (Route::has($menu['route'])){
            $this->href = route($menu['route']);
            $this->active_class = url()->current() == $this->href
                ? 'active'
                : '';
        }else{
            $this->href = "#{$menu['route']}";
        }

        if (isset($menu['auth']) && $menu['auth']){
            if (!Auth::check()){
                $this->should_render = false;
            }
        }
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.side-nav-item');
    }
}
