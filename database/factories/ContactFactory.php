<?php

namespace Database\Factories;

use App\Models\Contact;
use App\Models\Patient;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Contact>
 */
class ContactFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $contactable = fake()->randomElement([Patient::class, User::class]);

        return [
            'contactable_id' => $contactable::factory(),
            'contactable_type' => $contactable,
            'email' => fake()->unique()->safeEmail(),
            'phone' => '5551234567',
            'address' => fake()->streetAddress(),
            'city' => fake()->city(),
            'state' => fake()->stateAbbr(),
            'zip' => fake()->postcode(),
        ];
    }
}
