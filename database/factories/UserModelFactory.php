<?php


$factory->define('App\Users\User', function (Faker\Generator $faker) {
    return [
        'name' => $faker->userName,
        'password' => 1234,
    ];
});
