<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $users = factory(App\User::class, 10)->create();
        $categories=factory(App\Category::class,10)->create();
        $countries=factory(App\Country::class,10)->create();
        $comment=factory(App\Comment::class,10)->create();
        $films=factory(App\Film::class,10)->create()->each(function($film){

        $film->categories()->save(factory(App\Category::class)->make());
        $film->categories()->save(factory(App\Category::class)->make());
        $film->categories()->save(factory(App\Category::class)->make());
         }
       );


    }
}
