<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\FinancingCompany>
 */
class FinancingCompanyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        Storage::fake('public');

        return [
            'user_id' => \App\Models\User::factory(),
            'commercial_register_number' => $this->faker->unique()->numerify('##########'),
            'phone_number' => $this->faker->numerify('9665########'),
            'identity_image' => UploadedFile::fake()
                ->image('identity.jpg', 800, 600)
                ->store('financing_companies/identity', 'public'),
            'commercial_register_image' => UploadedFile::fake()
                ->image('commercial_register.jpg', 800, 600)
                ->store('financing_companies/commercial', 'public'),
            'description' => $this->faker->text(200),
            'address' => $this->faker->address,
            'created_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'updated_at' => now(),
        ];
    }
}
