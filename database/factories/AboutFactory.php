<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\About;
use App\User;
use Faker\Generator as Faker;

$factory->define(About::class, function (Faker $faker) {
    return [
        'user_id' => factory(User::class),
        'study_place' => $faker->sentence,
        'work_place' => $faker->sentence,
        'business' => $faker->sentence,
        'Location' => $faker->sentence,
        'contact' => $faker->sentence,
    ];
});
