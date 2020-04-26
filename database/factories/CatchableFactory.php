<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Catchable;
use Faker\Generator as Faker;

$factory->define(Catchable::class, function (Faker $faker) {
    return [
        'name' => $faker->company,
        'trip_id' => factory(App\Trip::class)->create()->id
    ];
});
