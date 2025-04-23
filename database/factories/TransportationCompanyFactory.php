<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TransportationCompany>
 */
class TransportationCompanyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => \App\Models\User::factory(), // assuming a user factory exists
            'commercial_register_number' => $this->faker->numerify('#############'),
            'phone_number' => $this->faker->phoneNumber,
            'identity_image' => $this->faker->imageUrl(640, 480, 'people', true, 'ID'),
            'commercial_register_image' => $this->faker->imageUrl(640, 480, 'business', true, 'CR'),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
