<?php

namespace Database\Factories;

use App\Models\Trip;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Trip>
 */
class TripFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Trip::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'transportation_company_id' => User::factory(), // Assumes 'users' table contains transportation companies
            'driver_name' => $this->faker->name(),
            'plate_number' => strtoupper($this->faker->bothify('??###')),
            'destination' => $this->faker->city(),
            'transport_type' => $this->faker->randomElement(['group', 'single']),
            'start' => $this->faker->address(),
            'end' => $this->faker->address(),
            'go_date' => $this->faker->dateTimeBetween('now', '+1 month'),
            'back_date' => $this->faker->dateTimeBetween('+1 month', '+2 months'),
            'trip_type' => $this->faker->randomElement(['one way', 'round trip']),
            'number_of_seats' => $this->faker->numberBetween(10, 50),
            'distance' => $this->faker->randomFloat(2, 10, 500) . ' km', // Random distance in kilometers
            'price' => $this->faker->randomFloat(2, 50, 1000), // Random price between 50 and 1000
            'image' => 'images/transportations/trans-default.jpg', // Random image URL
        ];
    }
}
