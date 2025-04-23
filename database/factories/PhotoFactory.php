<?php

namespace Database\Factories;

use App\Models\Housing;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Photo>
 */
class PhotoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'housing_id' => Housing::all()->random()->id,
            'path' => $this->faker->imageUrl(800, 600, 'housing', true),
            'is_primary' => $this->faker->boolean(20), // 20% chance of being primary
        ];
    }
}
