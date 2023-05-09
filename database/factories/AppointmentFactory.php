<?php

namespace Database\Factories;

use App\Models\AppointmentType;
use App\Models\Incident;
use App\Models\Location;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Appointment>
 */
class AppointmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $start = fake()->dateTimeBetween('now', '+6 months');
        $carbon = Carbon::parse($start);
        $minutes = ['15', '30', '45', '60', '75', '90', '105', '120'];
        $random = fake()->randomElement($minutes);
        $end = $carbon->add($random, 'minutes')->toDateTimeString();

        return [
            'scheduled_for' => User::factory(),
            'created_by' => User::factory(),
            'incident_id' => Incident::factory(),
            'location_id' => Location::factory(),
            'appointment_type_id' => AppointmentType::factory(),
            'start' => $start,
            'end' => $end,
        ];
    }
}
