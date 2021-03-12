<?php

use Faker\Generator as Faker;

$factory->define(App\Comment::class, function (Faker $faker) {
    return [
        'user_id' => $faker->numberBetween(1,5),
        'article_id' => $faker->numberBetween(1,10),
        'message' => $faker->text(50)
    ];
});
