<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Video;

class VideoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Video::create([
            'title' => 'خدمة تنظيف السجاد والموكيت بأحدث الأجهزة والتعقيم بالبخار',
            'url' => 'https://www.youtube.com/watch?v=kYJv8P7f5L0',
            'is_active' => true
        ]);

        Video::create([
            'title' => 'تعقيم وتنظيف وتلميع المطابخ وإزالة الدهون والزيوت الصعبة',
            'url' => 'https://www.youtube.com/watch?v=F3G8D2u4B8E',
            'is_active' => true
        ]);
    }
}
