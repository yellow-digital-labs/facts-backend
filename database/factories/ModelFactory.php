<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\MFoodsCategory::class, static function (Faker\Generator $faker) {
    return [
        'food_category_name' => $faker->sentence,
        'active' => $faker->boolean(),
        'created_at' => $faker->dateTime,
        'updated_at' => $faker->dateTime,
        
        
    ];
});
/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\MEventCategory::class, static function (Faker\Generator $faker) {
    return [
        'event_category_name' => $faker->sentence,
        'active' => $faker->boolean(),
        'created_at' => $faker->dateTime,
        'updated_at' => $faker->dateTime,
        
        
    ];
});
