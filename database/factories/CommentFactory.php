<?php

use Faker\Generator as Faker;

/* @var Illuminate\Database\Eloquent\Factory $factory */

$factory->define(App\Comment::class, function (Faker $faker) {
    return [

        'comment_body' => $faker->paragraph,
        'user_id' => function () {
                        return factory(App\User::class)->create()->id;
                       },
       'film_id' => function () {
                               return factory(App\Film::class)->create()->id;
                      },




    ];
});