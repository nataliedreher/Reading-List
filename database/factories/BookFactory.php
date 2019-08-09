<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Book;
use Faker\Generator as Faker;

$factory->define(Book::class, function (Faker $faker) {
    return [
        'email' => function () {
            return factory(App\User::class)->create()->email;
        },
        'author' => $faker->name,
        'title' => $faker->unique()->words,
        'subtitle' => $faker->unique()->sentence,
        'description' => $faker->unique()->paragraph,
    ];
});
