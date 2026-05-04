<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GallerySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\GalleryImage::truncate();

        $items = [
            ['title' => 'تنظيف مطبخ', 'icon' => 'fa-blender'],
            ['title' => 'تنظيف شامل', 'icon' => 'fa-home'],
            ['title' => 'تنظيف سجاد', 'icon' => 'fa-scroll'],
            ['title' => 'تنظيف كنب', 'icon' => 'fa-couch'],
            ['title' => 'تنظيف زجاج', 'icon' => 'fa-window-maximize'],
            ['title' => 'تعقيم وتطهير', 'icon' => 'fa-spray-can'],
            ['title' => 'تنظيف فيلا', 'icon' => 'fa-building'],
            ['title' => 'تنظيف حمام', 'icon' => 'fa-bath'],
        ];

        foreach ($items as $item) {
            \App\Models\GalleryImage::create($item);
        }
    }
}
