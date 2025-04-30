<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $users = [
            // Girls (consultants)
            [
                'name' => 'نورا أحمد',
                'email' => 'nora@example.com',
                'password' => Hash::make('12345678'),
                'role' => 'consultant',
                'is_approved' => '1',
                'profile_image' => 'images/consultants/6.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'سارة محمد',
                'email' => 'sara@example.com',
                'password' => Hash::make('12345678'),
                'role' => 'consultant',
                'is_approved' => '1',
                'profile_image' => 'images/consultants/7.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'لمى عبدالله',
                'email' => 'lama@example.com',
                'password' => Hash::make('12345678'),
                'role' => 'consultant',
                'is_approved' => '1',
                'profile_image' => 'images/consultants/8.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Boys (consultants)
            [
                'name' => 'أحمد خالد',
                'email' => 'ahmed@example.com',
                'password' => Hash::make('12345678'),
                'role' => 'consultant',
                'is_approved' => '1',
                'profile_image' => 'images/consultants/1.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'محمد علي',
                'email' => 'mohammed@example.com',
                'password' => Hash::make('12345678'),
                'role' => 'consultant',
                'is_approved' => '1',
                'profile_image' => 'images/consultants/2.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'خالد سعد',
                'email' => 'khaled@example.com',
                'password' => Hash::make('12345678'),
                'role' => 'consultant',
                'is_approved' => '1',
                'profile_image' => 'images/consultants/3.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Financing Companies (8 companies) - IDs 7-14
            [
                'name' => 'الشركة الوطنية للتمويل',
                'email' => 'national@example.com',
                'password' => Hash::make('12345678'),
                'role' => 'financing',
                'is_approved' => '1',
                'profile_image' => 'images/finances/1.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'تمويل السعودية',
                'email' => 'saudifinance@example.com',
                'password' => Hash::make('12345678'),
                'role' => 'financing',
                'is_approved' => '1',
                'profile_image' => 'images/finances/2.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'الراجحي المالية',
                'email' => 'alrajhi@example.com',
                'password' => Hash::make('12345678'),
                'role' => 'financing',
                'is_approved' => '1',
                'profile_image' => 'images/finances/3.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'التمويل المتقدم',
                'email' => 'advanced@example.com',
                'password' => Hash::make('12345678'),
                'role' => 'financing',
                'is_approved' => '1',
                'profile_image' => 'images/finances/4.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'تمويل المستقبل',
                'email' => 'future@example.com',
                'password' => Hash::make('12345678'),
                'role' => 'financing',
                'is_approved' => '1',
                'profile_image' => 'images/finances/5.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'الشرق الأوسط للتمويل',
                'email' => 'mefinance@example.com',
                'password' => Hash::make('12345678'),
                'role' => 'financing',
                'is_approved' => '1',
                'profile_image' => 'images/finances/6.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'الخليج للتمويل',
                'email' => 'gulf@example.com',
                'password' => Hash::make('12345678'),
                'role' => 'financing',
                'is_approved' => '1',
                'profile_image' => 'images/finances/7.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'التمويل السريع',
                'email' => 'quick@example.com',
                'password' => Hash::make('12345678'),
                'role' => 'financing',
                'is_approved' => '1',
                'profile_image' => 'images/finances/8.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            
            //  Housing Companies (3 companies) - IDs 15-17
            [
                'name' => 'دار السكن الطلابي',
                'email' => 'housing1@example.com',
                'password' => Hash::make('12345678'),
                'role' => 'housing',
                'is_approved' => '1',
                'profile_image' => 'housing1.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'المجمع السكني الأكاديمي',
                'email' => 'housing2@example.com',
                'password' => Hash::make('12345678'),
                'role' => 'housing',
                'is_approved' => '1',
                'profile_image' => 'housing2.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'سكن الطالبات المميز',
                'email' => 'housing3@example.com',
                'password' => Hash::make('12345678'),
                'role' => 'housing',
                'is_approved' => '1',
                'profile_image' => 'housing3.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'أبراج الجامعة السكنية',
                'email' => 'housing4@example.com',
                'password' => Hash::make('12345678'),
                'role' => 'housing',
                'is_approved' => '1',
                'profile_image' => 'housing4.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],

        ];

        DB::table('users')->insert($users);
    }
}
