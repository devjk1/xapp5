<?php

namespace Database\Factories;

use App\Models\Inventory;
use App\Models\InvoiceItem;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\InventoryTransaction>
 */
class InventoryTransactionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'inventory_id' => Inventory::factory(),
            'invoice_item_id' => InvoiceItem::factory(),
            'quantity' => fake()->numberBetween(1, 100),
        ];
    }
}
