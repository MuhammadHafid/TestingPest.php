<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Article;
use Faker\Generator as Faker;

$factory->define(Article::class, function (Faker $faker) {
    return [
        'user_id' => function () {
            return factory(App\Models\User::class)->create()->id;
        },
        'title' => $faker->sentence(3),
        'content' => $faker->sentence(10),
        'category_id' => function () {
            return factory(App\Models\Category::class)->create()->id;
        },
 ];
});
