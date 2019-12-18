<?php

use Faker\Generator as Faker;
use App\User;

$factory->define(App\Models\Status::class, function (Faker $faker) {
    return [
        'body'=> $faker->paragraph,
        'user_id' => function(){
            return factory(User::class)->create();
        }
    ];
});

