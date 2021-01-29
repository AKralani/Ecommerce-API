<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model\ReceivedProduct;
use Faker\Generator as Faker;

$factory->define(ReceivedProduct::class, function (Faker $faker) {
    return [
        'product_id' => function() {
            return App\Model\Product::all()->random();
        },

        'total_amount' => $faker->numberBetween(1, 100)
    ];
});
