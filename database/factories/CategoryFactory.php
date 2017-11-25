<?php

use Faker\Generator as Faker;

/* @var Illuminate\Database\Eloquent\Factory $factory */

$factory->define(App\Category::class, function (Faker $faker) {
    return [
        'category_title' => substr($faker->sentence(2), 0, -1)


    ];
});