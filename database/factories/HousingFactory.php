<?php

namespace Database\Factories;

use App\Models\Housing;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class HousingFactory extends Factory
{
    protected $model = Housing::class;

    public function definition()
    {
        return [

            'housing_company_id' => User::factory()->create(['role' => 'transportation'])->id, // assuming the housing company is a user
            'address' => $this->faker->address,
            'distance_from_university' => $this->faker->randomFloat(2, 0.5, 20.0), // in km
            'price' => $this->faker->randomFloat(2, 1000, 5000),
            'description' => $this->faker->paragraph,
            'features' => $this->faker->optional()->sentence,
            'housing_type' => $this->faker->randomElement(['Apartment', 'Villa', 'Studio', 'Shared Room']),
            'rules' => $this->faker->sentence(10),
        ];
    }
}
