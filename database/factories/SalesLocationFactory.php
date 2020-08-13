<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Providers\StateMapServiceProvider;
use App\SalesLocation;
use Faker\Generator as Faker;

$factory->define(SalesLocation::class, function (Faker $faker) {
    return [
        'state' => StateMapServiceProvider::$___valid_map_sample['state'],
        'location' => $faker->city
    ];
});
