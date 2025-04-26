<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FinancingCompaniesTableSeeder extends Seeder
{
    public function run()
    {
        $companies = [
            [
                'user_id' => 7,
                'address' => 'الرياض، حي المركز',
                'description' => 'شركة رائدة في مجال التمويل العقاري',
                'commercial_register_number' => '1012345678',
                'phone_number' => '0112345678',
                'identity_image' => 'company_identity_1.jpg',
                'commercial_register_image' => 'commercial_register_1.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 8,
                'address' => 'جدة، حي الشمال',
                'description' => 'شركة رائدة في مجال التمويل الاستثماري',
                'commercial_register_number' => '1023456789',
                'phone_number' => '0123456789',
                'identity_image' => 'company_identity_2.jpg',
                'commercial_register_image' => 'commercial_register_2.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 9,
                'address' => 'الدمام، حي الشرق',
                'description' => 'شركة رائدة في مجال التمويل الشخصي',
                'commercial_register_number' => '1034567890',
                'phone_number' => '0134567890',
                'identity_image' => 'company_identity_3.jpg',
                'commercial_register_image' => 'commercial_register_3.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 10,
                'address' => 'مكة، حي الغرب',
                'description' => 'شركة رائدة في مجال التمويل التجاري',
                'commercial_register_number' => '1045678901',
                'phone_number' => '0145678901',
                'identity_image' => 'company_identity_4.jpg',
                'commercial_register_image' => 'commercial_register_4.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 11,
                'address' => 'المدينة، حي الجنوب',
                'description' => 'شركة رائدة في مجال التمويل الصناعي',
                'commercial_register_number' => '1056789012',
                'phone_number' => '0156789012',
                'identity_image' => 'company_identity_5.jpg',
                'commercial_register_image' => 'commercial_register_5.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 12,
                'address' => 'الخبر، حي الروضة',
                'description' => 'شركة رائدة في مجال التمويل الزراعي',
                'commercial_register_number' => '1067890123',
                'phone_number' => '0167890123',
                'identity_image' => 'company_identity_6.jpg',
                'commercial_register_image' => 'commercial_register_6.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 13,
                'address' => 'الطائف، حي النزهة',
                'description' => 'شركة رائدة في مجال التمويل التعليمي',
                'commercial_register_number' => '1078901234',
                'phone_number' => '0178901234',
                'identity_image' => 'company_identity_7.jpg',
                'commercial_register_image' => 'commercial_register_7.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 14,
                'address' => 'بريدة، حي الخالدية',
                'description' => 'شركة رائدة في مجال التمويل الصحي',
                'commercial_register_number' => '1089012345',
                'phone_number' => '0189012345',
                'identity_image' => 'company_identity_8.jpg',
                'commercial_register_image' => 'commercial_register_8.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ];

        DB::table('financing_companies')->insert($companies);
    }
}
