<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Profile;
use App\Providers\StateMapServiceProvider;
use Faker\Generator as Faker;

$factory->define(Profile::class, function (Faker $faker) {
    return [
        'user_id' => function () {
            return factory(App\User::class)->create()->id;
        },
        'avatar_token' => '',
        'first_name' => $faker->firstName(),
        'last_name' => $faker->lastName,
        'state' => array_rand(StateMapServiceProvider::$___state_map),
        'city' => $faker->city,
        'address' => $faker->realText(rand(16,32)),
        'about' => $faker->realText(rand(512, 1024))
    ];
});
