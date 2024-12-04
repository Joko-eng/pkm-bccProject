<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Unit>
 */
class UnitFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->numberBetween(201, 254),
            'description' => 'Stylish, spacious and bright with an open-concept bedroom and bathroom, and a private balcony with daybed. Room includes two single beds, a desk, a small sofa and a floor-to-ceiling window for maximum natural light.',
            'max_person' => 2
        ];
    }
}
