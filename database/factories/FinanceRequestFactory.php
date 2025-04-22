<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class FinanceRequestFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'financing_company_id' => User::factory()->create(['role' => 'financing'])->id,
            'student_id' => User::factory()->create(['role' => 'student'])->id,
            'description' => $this->faker->paragraph,
            'amount' => $this->faker->randomFloat(2, 1000, 50000),
            'installment_period' => $this->faker->randomElement(['6 شهور', '12 شهر', '24 شهر', '36 شهر']),
            'finance_type' => $this->faker->randomElement(['education']),
            'is_agreed' => $this->faker->boolean,
            'terms_and_conditions' => $this->faker->randomElement(['0', '1', '2']),
            'status' => $this->faker->randomElement(['under_review', 'completed', 'rejected', 'accepted']),
            'reply' => $this->faker->optional()->paragraph,
        ];
    }
}
