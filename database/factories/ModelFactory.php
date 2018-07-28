<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;
    $data_time = $faker->date.' '.$faker->time;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
        'created_at' => $data_time,
        'updated_at' => $data_time,
    ];
});

$factory->define(App\Post::class, function (Faker\Generator $faker) {
     
    $datetime = $faker->date.' '.$faker->time;

    return [
        'title'   => $faker->sentence(6),
        'content' => $faker->paragraph(18),
        'user_id' => '2',
        'created_at' => $datetime,
        'updated_at' => $datetime,
    ];
});
