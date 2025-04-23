<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Student>
 */
class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'user_id' => User::where('role', 'student')->inRandomOrder()->first()->id,
            'university_number' => $this->faker->unique()->numerify('STU#####'),
            'university_name' => $this->faker->randomElement([
                'University of Example',
                'Tech Institute',
                'State College',
                'Global University',
                'City Academy'
            ]),
            'student_address' => $this->faker->address,
            'student_phone_number' => $this->faker->phoneNumber,
        ];
    }
}
