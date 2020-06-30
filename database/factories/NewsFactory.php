<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\News;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(News::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence(rand(2, 4), true),
        'description' => $faker->paragraph,
        'image' => function () {
            return '1593553854.jpeg';
        },
        'date' => $faker->date('Y-m-d'),
        'category_id' => rand(1, 5),
    ];
});
