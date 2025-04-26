<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PhotosTableSeeder extends Seeder
{
    public function run()
    {
        $photos = [];

        // Housing Unit 1 (ID 1)
        $photos[] = [
            'housing_id' => 1,
            'path' => 'images/houses/11.jpg',
            'is_primary' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ];
        $photos[] = [
            'housing_id' => 1,
            'path' => 'images/houses/10.jpg',
            'is_primary' => false,
            'created_at' => now(),
            'updated_at' => now(),
        ];
        $photos[] = [
            'housing_id' => 1,
            'path' => 'images/houses/9.jpg',
            'is_primary' => false,
            'created_at' => now(),
            'updated_at' => now(),
        ];

        // Housing Unit 2 (ID 2)
        $photos[] = [
            'housing_id' => 2,
            'path' => 'images/houses/6.jpg',
            'is_primary' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ];
        $photos[] = [
            'housing_id' => 2,
            'path' => 'images/houses/5.jpg',
            'is_primary' => false,
            'created_at' => now(),
            'updated_at' => now(),
        ];

        // Housing Unit 3 (ID 3)
        $photos[] = [
            'housing_id' => 2,
            'path' => 'images/houses/7.jpg',
            'is_primary' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ];
        $photos[] = [
            'housing_id' => 3,
            'path' => 'images/houses/3.jpg',
            'is_primary' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ];
        $photos[] = [
            'housing_id' => 3,
            'path' => 'images/houses/2.jpg',
            'is_primary' => false,
            'created_at' => now(),
            'updated_at' => now(),
        ];

        // Housing Unit 4 (ID 4)
        $photos[] = [
            'housing_id' => 3,
            'path' => 'images/houses/4.jpg',
            'is_primary' => false,
            'created_at' => now(),
            'updated_at' => now(),
        ];

        // Housing Unit 5 (ID 5)
        $photos[] = [
            'housing_id' => 3,
            'path' => 'images/houses/1.jpg',
            'is_primary' => false,
            'created_at' => now(),
            'updated_at' => now(),
        ];
        // $photos[] = [
        //     'housing_id' => 5,
        //     'path' => 'images/houses/5/security.jpg',
        //     'is_primary' => false,
        //     'created_at' => now(),
        //     'updated_at' => now(),
        // ];

        // // Housing Unit 6 (ID 6)
        // $photos[] = [
        //     'housing_id' => 6,
        //     'path' => 'images/houses/6/main.jpg',
        //     'is_primary' => true,
        //     'created_at' => now(),
        //     'updated_at' => now(),
        // ];
        // $photos[] = [
        //     'housing_id' => 6,
        //     'path' => 'images/houses/6/pool.jpg',
        //     'is_primary' => false,
        //     'created_at' => now(),
        //     'updated_at' => now(),
        // ];
        // $photos[] = [
        //     'housing_id' => 6,
        //     'path' => 'images/houses/6/gym.jpg',
        //     'is_primary' => false,
        //     'created_at' => now(),
        //     'updated_at' => now(),
        // ];

        // Housing Unit 7 (ID 7)
        // $photos[] = [
        //     'housing_id' => 7,
        //     'path' => 'images/houses/7/main.jpg',
        //     'is_primary' => true,
        //     'created_at' => now(),
        //     'updated_at' => now(),
        // ];
        // $photos[] = [
        //     'housing_id' => 7,
        //     'path' => 'images/houses/7/bedroom.jpg',
        //     'is_primary' => false,
        //     'created_at' => now(),
        //     'updated_at' => now(),
        // ];

        DB::table('photos')->insert($photos);
    }
}
