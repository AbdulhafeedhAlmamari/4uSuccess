<?php

namespace Database\Seeders;

use App\Models\Consultant;
use App\Models\ConsultationRequest;
use App\Models\Contact;
use App\Models\FinancingCompany;
use App\Models\Student;
use App\Models\User;
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
        User::factory(7)->create();
        Contact::factory(7)->create();
        Consultant::factory(7)->create();
        ConsultationRequest::factory(7)->create();
        Student::factory(7)->create();
        FinancingCompany::factory(7)->create();
        // admin user
        User::Create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('12345678'),
            'role' => 'admin',
            'is_approved' => '1',
            'profile_image' => 'https://ui-avatars.com/api/?name=admin&background=random',
        ]);

    }
}
