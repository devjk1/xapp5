<?php

namespace Database\Factories;

use App\Models\Medication;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OrderItem>
 */
class OrderItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $oitemable = fake()->randomElement([Medication::class, Product::class]);

        return [
            'order_id' => Order::factory(),
            'oitemable_id' => $oitemable::factory(),
            'oitemable_type' => $oitemable,
            'quantity' => fake()->numberBetween(1, 100),
            'price' => fake()->numberBetween(100, 100000),
        ];
    }
}
