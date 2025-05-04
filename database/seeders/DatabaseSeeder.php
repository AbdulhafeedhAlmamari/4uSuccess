<?php

namespace Database\Seeders;

use App\Models\Consultant;
use App\Models\ConsultationRequest;
use App\Models\Contact;
use App\Models\FinanceRequest;
use App\Models\FinancingCompany;
use App\Models\Housing;
use App\Models\HousingCompany;
use App\Models\Photo;
use App\Models\ReservationRequest;
use App\Models\Student;
use App\Models\TransportationCompany;
use App\Models\Trip;
use App\Models\User;
use Database\Factories\HousingCompanyFactory;
use Database\Factories\TripFactory;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UsersTableSeeder::class,
            ConsultantsTableSeeder::class,
            FinancingCompaniesTableSeeder::class,
            HousingTableSeeder::class,
            PhotosTableSeeder::class,
        ]);

        // User::factory(7)->create();
        // Contact::factory(7)->create();
        // Housing::factory(7)->create();
        // TransportationCompany::factory(7)->create();
        // Consultant::factory(7)->create();
        // ConsultationRequest::factory(7)->create();
        // Student::factory(7)->create();
        // FinancingCompany::factory(7)->create();
        // FinanceRequest::factory(7)->create();
        // HousingCompany::factory(7)->create();
        // TransportationCompany::factory(3)->create();
        // Trip::factory(7)->create();
        // Photo::factory(7)->create();
        // ReservationRequest::factory(3)->create();
        // // admin user
        User::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('12345678'),
            'role' => 'admin',
            'is_approved' => '1',
            'profile_image' => 'https://ui-avatars.com/api/?name=admin&background=random',
        ]);
    }
}
