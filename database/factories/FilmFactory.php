<?php

use Faker\Generator as Faker;

/* @var Illuminate\Database\Eloquent\Factory $factory */

$factory->define(App\Film::class, function (Faker $faker) {
    return [
        'name' => substr($faker->sentence(2), 0, -1),
        'description' => $faker->paragraph,
        'release_year'=>$faker->dateTime(),
        'ticket_price'=>$faker->randomNumber(3),
        'rating'=>$faker->randomNumber(1),
         'country_id' => function () {
                               return factory(App\Country::class)->create()->id;
                           }


    ];
});