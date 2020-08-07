<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class StateMapServiceProvider extends ServiceProvider
{
    public static $___state_map = [
        '10' => [
            'name' => "Abia",
            'lga' => [
                '1010' => 'Umuahia'
            ]
        ],
        '11' => [
            'name' => 'Adamawa',
            'lga' => [
                '1110' => 'Yola'
            ]
        ],
        '12' => [
            'name' => 'Akwa Ibom',
            'lga' => [
                '1210' => 'Uyo'
            ]
        ],
        '13' => [
            'name' => 'Anambra',
            'lga' => [
                '1310' => 'Akwa'
            ]
        ],
    ];

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
        View::share('___state_map', self::$___state_map);
    }
}
