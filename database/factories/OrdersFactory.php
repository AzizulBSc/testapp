<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

namespace Database\Factories;
use App\Models\Orders;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factories\Factory;
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

class OrdersFactory extends Factory
{

 public function definition(): array
    {
    $products = ['Mobile', 'Laptop', 'Watch', 'Mac Book'];
    static $invoice = 20;

    return [
        'product_name' => $products[rand(0, 3)],
        'currency' => 'BDT',
        'amount' => rand(1500, 2000),
        'invoice' => $invoice++,
        'status' => 'Pending',
    ];
    }
}
