<?php

$factory->define('App\Users\UserStat', function (Faker\Generator $faker) {
    return [
                'user_id'         => 1,
                'question_id'     => $faker->randomNumber,
                'question_result' => $faker->randomNumber,
                'category_id'     => $faker->randomNumber,
                'class_id'        => $faker->randomNumber,
    ];
});
