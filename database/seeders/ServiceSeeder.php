<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        $services = [
            ['name' => 'تنظيف المنازل', 'icon' => 'fa-home', 'description' => 'تنظيف شامل وعميق لجميع غرف المنزل', 'is_active' => true],
            ['name' => 'تنظيف الفلل', 'icon' => 'fa-building', 'description' => 'خدمة نظافة متكاملة للفلل الكبيرة', 'is_active' => true],
            ['name' => 'تنظيف الشقق', 'icon' => 'fa-door-open', 'description' => 'تنظيف الشقق السكنية والمفروشة', 'is_active' => true],
            ['name' => 'تنظيف السجاد', 'icon' => 'fa-rug', 'description' => 'إزالة البقع والأتربة من السجاد', 'is_active' => true],
            ['name' => 'تنظيف الكنب', 'icon' => 'fa-couch', 'description' => 'تنظيف وتلميع جميع أنواع الكنب', 'is_active' => true],
            ['name' => 'تنظيف المجالس', 'icon' => 'fa-chair', 'description' => 'تنظيف مجالس رجالي ونسائي', 'is_active' => true],
            ['name' => 'تنظيف الموكيت', 'icon' => 'fa-border-all', 'description' => 'تنظيف وتعطير الموكيت والسجاد', 'is_active' => true],
            ['name' => 'تنظيف المطابخ', 'icon' => 'fa-blender', 'description' => 'تنظيف عميق للمطابخ والأجهزة', 'is_active' => true],
            ['name' => 'تنظيف الحمامات', 'icon' => 'fa-bath', 'description' => 'تعقيم وتطهير الحمامات كاملاً', 'is_active' => true],
            ['name' => 'تنظيف الخزانات', 'icon' => 'fa-water', 'description' => 'تنظيف وتعقيم خزانات المياه', 'is_active' => true],
            ['name' => 'تنظيف الزجاج', 'icon' => 'fa-window-maximize', 'description' => 'تنظيف الزجاج والواجهات', 'is_active' => true],
            ['name' => 'تنظيف بعد التشطيب', 'icon' => 'fa-hammer', 'description' => 'إزالة آثار الدهان والإنشاء', 'is_active' => true],
            ['name' => 'تنظيف المكاتب', 'icon' => 'fa-briefcase', 'description' => 'تنظيف الشركات والمكاتب', 'is_active' => true],
            ['name' => 'التعقيم والتطهير', 'icon' => 'fa-shield-virus', 'description' => 'تعقيم شامل ضد الجراثيم', 'is_active' => true],
            ['name' => 'تنظيف عميق', 'icon' => 'fa-spray-can', 'description' => 'تنظيف عميق متكامل', 'is_active' => true],
            ['name' => 'إزالة الروائح', 'icon' => 'fa-wind', 'description' => 'إزالة الروائح غير المرغوبة', 'is_active' => true],
        ];

        foreach ($services as $service) {
            Service::create($service);
        }
    }
}
