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
/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\Event::class, static function (Faker\Generator $faker) {
    return [
        'user_id' => $faker->sentence,
        'event_categories_id' => $faker->sentence,
        'event_name' => $faker->sentence,
        'event_start_datetime' => $faker->dateTime,
        'event_end_datetime' => $faker->dateTime,
        'event_description' => $faker->text(),
        'event_primary_image' => $faker->sentence,
        'event_location' => $faker->sentence,
        'event_contact' => $faker->sentence,
        'event_available_tickets' => $faker->randomNumber(5),
        'event_ticket_amount' => $faker->randomNumber(5),
        'event_ticket_discount_amount' => $faker->randomNumber(5),
        'active' => $faker->boolean(),
        'created_at' => $faker->dateTime,
        'updated_at' => $faker->dateTime,
        
        
    ];
});
/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\EventsOrder::class, static function (Faker\Generator $faker) {
    return [
        'created_at' => $faker->dateTime,
        'updated_at' => $faker->dateTime,
        
        
    ];
});
/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\EventsOrder::class, static function (Faker\Generator $faker) {
    return [
        'booking_user_id' => $faker->sentence,
        'event_user_id' => $faker->sentence,
        'event_id' => $faker->sentence,
        'no_of_booking' => $faker->randomNumber(5),
        'booking_unit_amount' => $faker->randomFloat,
        'applicable_tax_amount' => $faker->randomFloat,
        'booking_total_amount' => $faker->randomFloat,
        'points_used' => $faker->randomNumber(5),
        'booking_payable_amount' => $faker->randomFloat,
        'status' => $faker->sentence,
        'created_at' => $faker->dateTime,
        'updated_at' => $faker->dateTime,
        
        
    ];
});
/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\MUserType::class, static function (Faker\Generator $faker) {
    return [
        'name' => $faker->firstName,
        'active' => $faker->boolean(),
        'created_at' => $faker->dateTime,
        'updated_at' => $faker->dateTime,
        
        
    ];
});
/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\MEventsOrdersStatus::class, static function (Faker\Generator $faker) {
    return [
        'events_orders_status_name' => $faker->sentence,
        'active' => $faker->boolean(),
        'created_at' => $faker->dateTime,
        'updated_at' => $faker->dateTime,
        
        
    ];
});
