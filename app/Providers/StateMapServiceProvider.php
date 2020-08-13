<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class StateMapServiceProvider extends ServiceProvider
{
    public static $___valid_map_sample = [
        'state' => '10'
    ];

    public static $___state_map = [
        '10' => [
            'name' => "Abia",
            'lga' => [
                '10' => 'Umuahia'
            ]
        ],
        '11' => [
            'name' => 'Adamawa',
            'lga' => [
                '10' => 'Yola'
            ]
        ],
        '12' => [
            'name' => 'Akwa Ibom',
            'lga' => [
                '10' => 'Uyo'
            ]
        ],
        '13' => [
            'name' => 'Anambra',
            'lga' => [
                '10' => 'Akwa'
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
