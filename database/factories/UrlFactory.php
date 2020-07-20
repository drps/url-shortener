<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;

$factory->define(\App\Entities\Url::class, function (Faker $faker) {
    return [
        'url' => $faker->url,
        'short_url' => $faker->unique()->safeEmail,
        'is_commercial' => $faker->boolean,
        'expire_at' => $faker->dateTime,
        'created_at' => $faker->dateTime,
        'updated_at' => $faker->dateTime,
    ];
});
