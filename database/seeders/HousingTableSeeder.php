<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HousingTableSeeder extends Seeder
{
    public function run()
    {
        $housingUnits = [
            // Housing Company 1 (ID 15)
            [
                'housing_company_id' => 15,
                'address' => 'الرياض، حي الجامعة، شارع الملك عبدالله',
                'distance_from_university' => 1.5,
                'price' => 12000.00,
                'description' => 'سكن طلابي فاخر قريب من الجامعة مع جميع الخدمات',
                'features' => 'واي فاي مجاني, صالة رياضية, غسيل ملابس, مواقف سيارات',
                'housing_type' => 'سكن مشترك',
                'rules' => 'منع الزيارات بعد منتصف الليل, الالتزام بالهدوء, عدم السماح بالحيوانات الأليفة',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'housing_company_id' => 16,
                'address' => 'الرياض، حي النخيل، شارع الأمير محمد',
                'distance_from_university' => 3.2,
                'price' => 8000.00,
                'description' => 'شقق مفروشة للطلاب بأسعار مناسبة',
                'features' => 'مطبخ مشترك, غرف دراسة, مواقف سيارات',
                'housing_type' => 'شقق فردية',
                'rules' => 'منع التدخين, الحفاظ على النظافة, الالتزام بمواعيد الزيارة',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Housing Company 2 (ID 16)
            [
                'housing_company_id' => 17,
                'address' => 'جدة، حي الجامعة، شارع الأمير سلطان',
                'distance_from_university' => 0.8,
                'price' => 15000.00,
                'description' => 'مجمع سكني أكاديمي مع خدمات متكاملة',
                'features' => 'مطعم داخلي, مكتبة, صالة تلفزيون, خدمة تنظيف أسبوعية',
                'housing_type' => 'سكن مشترك',
                'rules' => 'التزام بالزي الرسمي في المناطق العامة, منع استقبال الضيوف في الغرف',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Housing Company 3 (ID 17)
            // [
            //     'housing_company_id' => 18,
            //     'address' => 'الدمام، حي الثقبة، شارع الملك فيصل',
            //     'distance_from_university' => 2.5,
            //     'price' => 9000.00,
            //     'description' => 'سكن طالبات مميز مع مرافق آمنة',
            //     'features' => 'نظام أمني 24 ساعة, مواقف سيارات مغطاة, صالة نسائية',
            //     'housing_type' => 'سكن نسائي',
            //     'rules' => 'منع الزيارات الذكورية, الالتزام بالحجاب في المناطق العامة, منع استخدام الأدوات الكهربائية في الغرف',
            //     'created_at' => now(),
            //     'updated_at' => now(),
            // ],
            // [
            //     'housing_company_id' => 19,
            //     'address' => 'الدمام، حي الشاطئ، شارع الأمير نايف',
            //     'distance_from_university' => 4.0,
            //     'price' => 7500.00,
            //     'description' => 'وحدات سكنية اقتصادية للطالبات',
            //     'features' => 'غرف مزدوجة, مطبخ مشترك, خدمة تنظيف',
            //     'housing_type' => 'سكن نسائي',
            //     'rules' => 'تسليم جواز السفر للإدارة, منع السفر بدون إذن, الالتزام بمواعيد الدخول والخروج',
            //     'created_at' => now(),
            //     'updated_at' => now(),
            // ],

            // Housing Company 4 (ID 18)
            // [
            //     'housing_company_id' => 20,
            //     'address' => 'الرياض، حي العليا، شارع العليا العام',
            //     'distance_from_university' => 5.0,
            //     'price' => 18000.00,
            //     'description' => 'أبراج سكنية فاخرة للطلاب المتميزين',
            //     'features' => 'حارس أمن 24 ساعة, مصعد, مسبح, صالة ألعاب رياضية',
            //     'housing_type' => 'شقق فاخرة',
            //     'rules' => 'منع إقامة الحفلات, الالتزام بمواعيد الصيانة, دفع الكفالة قبل التسليم',
            //     'created_at' => now(),
            //     'updated_at' => now(),
            // ],
            // [
            //     'housing_company_id' => 21,
            //     'address' => 'الرياض، حي الورود، شارع الريان',
            //     'distance_from_university' => 3.7,
            //     'price' => 11000.00,
            //     'description' => 'شقق مفروشة للطلاب بمواصفات عالية',
            //     'features' => 'تكييف مركزي, انترنت فائق السرعة, خدمة تنظيف يومية',
            //     'housing_type' => 'شقق فردية',
            //     'rules' => 'منع التدخين داخل الوحدات, الالتزام بإجراءات السلامة, إبلاغ الإدارة عن أي أعطال',
            //     'created_at' => now(),
            //     'updated_at' => now(),
            // ],
        ];

        DB::table('housing')->insert($housingUnits);
    }
}
