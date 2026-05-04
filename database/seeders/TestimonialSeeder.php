<?php

namespace Database\Seeders;

use App\Models\Testimonial;
use Illuminate\Database\Seeder;

class TestimonialSeeder extends Seeder
{
    public function run(): void
    {
        $testimonials = [
            [
                'name' => 'أحمد العبدالله',
                'city' => 'بريدة',
                'rating' => 5,
                'service' => 'تنظيف فيلا',
                'content' => 'خدمة ممتازة ورائعة، الفريق محترف ومنظم، والنتيجة فاقت توقعاتي. أنصح بهم بشدة لكل من يريد تنظيفاً حقيقياً لمنزله.',
                'is_active' => true
            ],
            [
                'name' => 'منيرة السهلي',
                'city' => 'عنيزة',
                'rating' => 5,
                'service' => 'تنظيف كنب وسجاد',
                'content' => 'أفضل شركة تنظيف تعاملت معها في القصيم. الكنب خرج جديداً تماماً والسجاد لمع كأنه جديد. سأتعامل معهم دائماً.',
                'is_active' => true
            ],
            [
                'name' => 'خالد الرشيد',
                'city' => 'الرس',
                'rating' => 5,
                'service' => 'تنظيف بعد تشطيب',
                'content' => 'أنجزوا تنظيف بعد التشطيب في وقت قياسي وبجودة عالية جداً. فعلاً فريق محترف يعرف شغله جيداً.',
                'is_active' => true
            ],
        ];

        foreach ($testimonials as $testimonial) {
            Testimonial::create($testimonial);
        }
    }
}
