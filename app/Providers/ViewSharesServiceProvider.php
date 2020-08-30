<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewSharesServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::share('___side_nav_menus', [
            [
                'label' => 'My Profile',
                'icon' => 'fas fa-user',
                'route' => "profile.self"
            ],
            [
                'label' => 'Home',
                'icon' => 'fas fa-home',
                'route' => "home"
            ],
            [
                'label' => 'Store',
                'icon' => 'fas fa-store-alt',
                'route' => 'market'
            ],
            [
                'label' => 'Filter',
                'icon' => 'fas fa-filter',
                'route' => 'market_filter_modal',
                'more' => "data-toggle='modal' data-target='#market_filter_modal'"
            ],
            [
                'label' => 'Sell',
                'icon' => 'fas fa-plus',
                'route' => 'item.create',
                'auth' => true
            ],
        ]);
    }
}
