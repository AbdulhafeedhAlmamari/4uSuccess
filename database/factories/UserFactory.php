<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => Hash::make('12345678'), // 12345678
            'role' => $this->faker->randomElement(['student', 'financing', 'housing', 'transportation', 'consultant']),
            'is_approved' => $this->faker->randomElement(['0', '1', '2']),
            'profile_image' => $this->faker->optional()->imageUrl(200, 200, 'people'),
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }

    /**
     * Indicate that the user is a student.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function student()
    {
        return $this->state(function (array $attributes) {
            return [
                'role' => 'student',
            ];
        });
    }

    /**
     * Indicate that the user is a teacher.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function teacher()
    {
        return $this->state(function (array $attributes) {
            return [
                'role' => 'teacher',
            ];
        });
    }

    /**
     * Indicate that the user is an admin.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function admin()
    {
        return $this->state(function (array $attributes) {
            return [
                'role' => 'admin',
            ];
        });
    }

    /**
     * Indicate that the user is approved.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function approved()
    {
        return $this->state(function (array $attributes) {
            return [
                'is_approved' => '1',
            ];
        });
    }

    /**
     * Indicate that the user is not approved.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unapproved()
    {
        return $this->state(function (array $attributes) {
            return [
                'is_approved' => '0',
            ];
        });
    }
}
