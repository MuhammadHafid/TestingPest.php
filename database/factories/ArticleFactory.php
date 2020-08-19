<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Article;
use Faker\Generator as Faker;

$factory->define(Article::class, function (Faker $faker) {
    return [
        'user_id' => function () {
            return factory(App\Models\User::class)->create()->id;
        },
        'title' => $faker->words(10),
        'content' => $faker->sentence(10),
        'category_id' => $faker->randomNumber(1),
        'id' => $faker->randomNumber(1),
    ];
});
