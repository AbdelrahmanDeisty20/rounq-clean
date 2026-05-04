<?php

namespace Database\Seeders;

use App\Models\Offer;
use Illuminate\Database\Seeder;

class OfferSeeder extends Seeder
{
    public function run(): void
    {
        $offers = [
            [
                'title' => 'الباقة الأساسية',
                'old_price' => 249,
                'price' => 179,
                'is_active' => true,
                'is_featured' => false,
                'features' => "تنظيف 3 غرف\nتنظيف الصالة\nتنظيف مطبخ واحد\nتنظيف حمامين"
            ],
            [
                'title' => 'الباقة الذهبية ⭐',
                'old_price' => 449,
                'price' => 319,
                'is_active' => true,
                'is_featured' => true,
                'features' => "تنظيف شقة كاملة\nتنظيف الكنب\nتنظيف السجاد\nتعقيم وتطهير\nخدمة مميزة"
            ],
            [
                'title' => 'الباقة الماسية 💎',
                'old_price' => 699,
                'price' => 499,
                'is_active' => true,
                'is_featured' => false,
                'features' => "تنظيف فيلا كاملة\nتنظيف كنب وسجاد\nتنظيف بعد تشطيب\nتعقيم شامل\nضمان الجودة\nخدمة VIP"
            ],
        ];

        foreach ($offers as $offer) {
            Offer::create($offer);
        }
    }
}
