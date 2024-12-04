<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Guest>
 */
class GuestFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'phone' => fake()->unique()->phoneNumber(),
            'date_of_birth' => fake()->dateTime(),
            'gender' => fake()->randomElement(['male', 'female']),
            'address' => fake()->streetAddress(),
            'postal_code' => fake()->postcode(),
            'place_of_birth' => fake()->city()
        ];
    }
}
