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
                'label' => 'Home',
                'icon' => 'fas fa-home',
                'route' => "home"
            ],
            [
                'label' => 'Store',
                'icon' => 'fas fa-store-alt',
                'route' => 'home'
            ]
        ]);
    }
}
