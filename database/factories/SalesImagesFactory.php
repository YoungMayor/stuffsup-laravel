<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Facades\SalesImage as FacadesSalesImage;
use App\Sale;
use App\SalesImage;
use Faker\Generator as Faker;
use Illuminate\Http\UploadedFile;

$factory->define(SalesImage::class, function (Faker $faker, $sale) {
    $sale_object = isset($sale['item_id']) ? Sale::find($sale['item_id']) : null;
    $image = UploadedFile::fake()->image('uploaded_image.jpg', 4096, 4096);
    $paths = FacadesSalesImage::upload($image, $sale_object);

    return [
        'image_token' => $paths['full'],
        'preview_token' => $paths['preview'],
        'caption' => $faker->realText(128)
    ];
});
