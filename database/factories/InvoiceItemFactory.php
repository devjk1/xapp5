<?php

namespace Database\Factories;

use App\Models\Invoice;
use App\Models\Medication;
use App\Models\Prescription;
use App\Models\Procedure;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\InvoiceItem>
 */
class InvoiceItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $iitemable = fake()->randomElement([Medication::class, Prescription::class, Procedure::class, Product::class]);

        return [
            'invoice_id' => Invoice::factory(),
            'iitemable_id' => $iitemable::factory(),
            'iitemable_type' => $iitemable,
            'quantity' => fake()->numberBetween(1, 100),
            'price' => fake()->numberBetween(100, 100000),
        ];
    }
}
