<?php

namespace Database\Factories;

use App\Models\TransportationCompany;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class TransportationCompanyFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = TransportationCompany::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory()->create(['role' => 'transportation'])->id,
            'commercial_register_number' => $this->faker->unique()->numerify('CR########'),
            'phone_number' => $this->faker->phoneNumber(),
            'identity_image' => 'identity_' . $this->faker->unique()->word() . '.jpg',
            'commercial_register_image' => 'commercial_register_' . $this->faker->unique()->word() . '.jpg',
        ];
    }
}
