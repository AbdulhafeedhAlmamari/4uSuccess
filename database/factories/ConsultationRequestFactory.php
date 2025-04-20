<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ConsultationRequestFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'student_id' => User::factory(),
            'specialization' => $this->faker->randomElement(['الذكاء الاصطناعي', 'إدارة الاعمال', 'التربية الادبية', 'علوم الحاسب']),
            'consultant_id' => User::factory(),
            'subject' => $this->faker->sentence,
            'type' => $this->faker->randomElement(['academic', 'career', 'personal']),
            'gender' => $this->faker->numberBetween(0, 2), // Assuming 0=any, 1=male, 2=female
            'description' => $this->faker->paragraph,
            'status' => $this->faker->randomElement(['pending', 'approved', 'rejected', 'completed']),
            'request_date' => $this->faker->dateTimeBetween('now', '+1 month'),
        ];
    }
}
