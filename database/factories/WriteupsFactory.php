<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Writeup::class, function (Faker $faker) {
    return [
        //
        'user_id'=>factory(App\Models\User::class),
        'title' => $faker->sentence,
        'message' => $faker->sentence,
        'date'=>$faker->date()
    ];
});


