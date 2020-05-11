<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Customer;
use App\Models\Product;
use App\User;
use Bezhanov\Faker\Provider\Commerce;
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

$factory->define(User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->email,
    ];
});

$factory->define(Customer::class, function (Faker $faker) {
    return [
        'name' => $faker->name
        , 'last_name' => $faker->lastName
        , 'address' => $faker->address
        , 'identification' => Str::random(20)
    ];
});

$factory->define(Product::class, function(Faker $faker) {
    $faker->addProvider(new Commerce($faker));

    return [
        'sku' => Str::random(20)
        , 'name' => $faker->productName
        , 'description' => $faker->text(200)
        , 'price' => $faker->numberBetween(1,250)
    ];
});
