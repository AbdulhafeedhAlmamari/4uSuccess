<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\HousingCompany>
 */
class HousingCompanyFactory extends Factory
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
            'commercial_register_number' => $this->faker->unique()->numerify('CR########'),
            'phone_number' => $this->faker->phoneNumber,
            'identity_image' => UploadedFile::fake()
                ->image('identity.jpg', 800, 600)
                ->store('financing_companies/identity', 'public'),
            'commercial_register_image' => $this->faker->imageUrl(400, 300, 'business', true, 'CR'),
        ];
    }
}
