<?php

namespace Database\Factories;

use App\Models\Patient;
use App\Models\PaymentType;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Payment>
 */
class PaymentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'created_by' => User::factory(),
            'patient_id' => Patient::factory(),
            'payment_type_id' => PaymentType::factory(),
            'total' => fake()->numberBetween(100, 100000),
        ];
    }
}
