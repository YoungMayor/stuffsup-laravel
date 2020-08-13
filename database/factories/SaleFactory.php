<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Providers\ItemCategoryServiceProvider;
use App\Sale;
use Faker\Generator as Faker;

$factory->define(Sale::class, function (Faker $faker) {
    return [
        'token' => md5(uniqid()),
        'title' => $faker->realText(rand(64,250)),
        'description' => $faker->realText(rand(256, 1024)),
        'price' => $faker->regexify('[0-9]{2,6}\.[0-9]{2}'),
        'seller_id' => function () {
            return factory(App\User::class)->create()->id;
        },
        'phone' =>$faker->regexify('^(\+234|0)[7-8][01] [0-9]{4} [0-9]{4}$'),
        'category' => ItemCategoryServiceProvider::$___valid_map_sample,
        'is_public' => rand(0,1),
    ];
})->afterCreating(Sale::class, function($sale, $faker){
    factory(App\SalesImage::class)->create([
        'item_id' => $sale->id
    ]);

    factory(App\SalesLocation::class)->create([
        'item_id' => $sale->id
    ]);
});
