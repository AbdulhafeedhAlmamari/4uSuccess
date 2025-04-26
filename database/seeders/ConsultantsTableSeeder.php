<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ConsultantsTableSeeder extends Seeder
{
    public function run()
    {
        $consultants = [
            // Girls
            [
                'user_id' => 2,
                'phone_number' => '0567891234',
                'specialization' => 'الذكاء الاصطناعي',
                'consultation_duration' => '30 دقيقة',
                'activity_type' => 'خاص',
                'identity_image' => 'path/to/identity1.jpg',
                'certificate_image' => 'path/to/certificate1.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 3,
                'phone_number' => '0551234567',
                'specialization' => 'إدارة الاعمال',
                'consultation_duration' => '45 دقيقة',
                'activity_type' => 'حكومي',
                'identity_image' => 'path/to/identity2.jpg',
                'certificate_image' => 'path/to/certificate2.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 4,
                'phone_number' => '0549876543',
                'specialization' => 'علوم الحاسب',
                'consultation_duration' => '60 دقيقة',
                'activity_type' => 'خاص',
                'identity_image' => 'path/to/identity3.jpg',
                'certificate_image' => 'path/to/certificate3.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            
            // Boys
            [
                'user_id' => 5,
                'phone_number' => '0501122334',
                'specialization' => 'التربية الادبية',
                'consultation_duration' => '30 دقيقة',
                'activity_type' => 'حكومي',
                'identity_image' => 'path/to/identity4.jpg',
                'certificate_image' => 'path/to/certificate4.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 6,
                'phone_number' => '0598765432',
                'specialization' => 'إدارة الاعمال',
                'consultation_duration' => '45 دقيقة',
                'activity_type' => 'خاص',
                'identity_image' => 'path/to/identity5.jpg',
                'certificate_image' => 'path/to/certificate5.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 7,
                'phone_number' => '0587654321',
                'specialization' => 'الذكاء الاصطناعي',
                'consultation_duration' => '60 دقيقة',
                'activity_type' => 'حكومي',
                'identity_image' => 'path/to/identity6.jpg',
                'certificate_image' => 'path/to/certificate6.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('consultants')->insert($consultants);
    }
}