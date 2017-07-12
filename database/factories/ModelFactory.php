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

$factory->define(App\Comment::class, function (Faker\Generator $faker) {
    return [
        'uid' =>str_random(1),
    	'odid' => str_random(1),	
    	'grade' => str_random(1),
        'contents' => $faker->paragraph,
    ];
});
