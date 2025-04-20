<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ConsultantFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => \App\Models\User::factory(),
            'phone_number' => $this->faker->phoneNumber,
            'activity_type' => $this->faker->randomElement(['full-time', 'part-time', 'freelance']),
            'consultation_duration' => $this->faker->randomElement([30, 45, 60, 90]),
            'specialization' => $this->faker->randomElement([
                'Career Counseling',
                'Academic Advising',
                'Mental Health',
                'Relationship Coaching',
                'Financial Consulting'
            ]),
            'identity_image' => 'consultants/identities/'.$this->faker->uuid.'.jpg',
            'certificate_image' => 'consultants/certificates/'.$this->faker->uuid.'.jpg',
        ];
    }

    /**
     * Configure the model factory.
     *
     * @return $this
     */
    // public function configure()
    // {
    //     return $this->afterCreating(function (\App\Models\Consultant $consultant) {
    //         // You can add additional logic here after consultant creation
    //         // For example, assign consultant role to the user
    //         $consultant->user->assignRole('consultant');
    //     });
    // }
}