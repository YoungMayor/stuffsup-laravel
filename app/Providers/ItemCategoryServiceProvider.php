<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ItemCategoryServiceProvider extends ServiceProvider
{
    public static $___valid_map_sample = '101011';

    public static $___categories = [
        '10' => [
            'name' => 'Main 1',
            'sub' => [
                '10' => [
                    'name' => 'Main 1 sub 1',
                    'sub' => [
                        '10' => [
                            'name' => 'Main 1sub1 subsub 1'
                        ],
                        '11' => [
                            'name' => 'Main 1sub1 subsub 2'
                        ]
                    ]
                ]
            ]
        ],
        '11' => [
            'name' => 'Main 2',
            'sub' => [
                '10' => [
                    'name' => 'Main 2 sub 1'
                ]
            ]
        ],
        '12' => [
            'name' => 'Main 3'
        ]
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
        view()->share('___categories', self::$___categories);
    }
}
