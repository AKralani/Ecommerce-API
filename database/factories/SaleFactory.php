<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model\Sale;
use Laravel\Passport\Client;
use Faker\Generator as Faker;
use Illuminate\Foundation\Auth\User;

$factory->define(Sale::class, function (Faker $faker) {
    return [
        'user_id' => function() {
            return App\User::all()->random();
        },
        'client_id' => function() {
            return App\Model\Client::all()->random();
        },

        //test
        'product_id' => function() {
            return App\Model\Product::all()->random();
        }
    ];
});
