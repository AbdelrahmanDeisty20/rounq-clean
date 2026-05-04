<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Setting;

class SettingSeeder extends Seeder
{
    public function run(): void
    {
        $homeSettings = [
            'hero' => [
                'badge' => 'الأسطورة رونق قلب الخليج',
                'title' => 'خدمات نظافة احترافية في القصيم<br>لمنزل <span>يليق بك</span>',
                'desc' => 'نقدم أرقى خدمات التنظيف المتكاملة للمنازل والفلل والشقق والمكاتب في منطقة القصيم. فريق مدرب، مواد آمنة، نتائج مضمونة، وأسعار تنافسية.',
                'image' => '',
                'btn1' => ['text' => 'اطلب الخدمة الآن', 'link' => '#request-modal'],
                'btn2' => ['text' => 'تواصل واتساب', 'link' => 'https://wa.me/966550000000'],
                'stats' => [
                    ['num' => '500+', 'label' => 'عميل راضٍ'],
                    ['num' => '5+', 'label' => 'سنوات خبرة'],
                    ['num' => '16', 'label' => 'خدمة متخصصة']
                ]
            ],
            'why' => [
                'badge' => 'لماذا نحن',
                'title' => 'لماذا تختار<br><span class="text-gold">الأسطورة رونق قلب الخليج؟</span>',
                'desc' => 'نحن لسنا مجرد شركة تنظيف، نحن شركاؤك في الحفاظ على بيئة منزلية صحية ونظيفة. نجمع بين الخبرة العالية والمواد الآمنة والفريق المدرب لنقدم لك أفضل تجربة تنظيف في القصيم.',
                'features' => [
                    ['icon' => 'fa-users', 'title' => 'فريق مدرب ومحترف', 'desc' => 'عمالة مدربة على أعلى مستوى من الكفاءة والأمانة'],
                    ['icon' => 'fa-leaf', 'title' => 'مواد آمنة وصديقة للبيئة', 'desc' => 'نستخدم منظفات آمنة لأسرتكم وأطفالكم وحيواناتكم الأليفة'],
                    ['icon' => 'fa-clock', 'title' => 'التزام بالمواعيد', 'desc' => 'نحترم وقتك ونلتزم بالموعد المحدد دائماً'],
                    ['icon' => 'fa-shield-alt', 'title' => 'ضمان الرضا الكامل', 'desc' => 'إذا لم تكن راضياً تماماً، سنعيد العمل مجاناً'],
                    ['icon' => 'fa-tags', 'title' => 'أسعار تنافسية وشفافة', 'desc' => 'لا رسوم خفية، أسعار واضحة قبل البدء بالعمل']
                ],
                'badgeNum' => '100%',
                'badgeLabel' => 'رضا العملاء'
            ],
            'steps' => [
                'badge' => 'آلية العمل',
                'title' => 'كيف <span class="text-gold">نعمل؟</span>',
                'desc' => 'خطوات بسيطة للحصول على خدمة نظافة احترافية في منزلك',
                'items' => [
                    ['icon' => 'fa-phone-alt', 'title' => 'تواصل معنا', 'desc' => 'اتصل بنا أو تواصل عبر واتساب لطلب الخدمة'],
                    ['icon' => 'fa-clipboard-list', 'title' => 'نقيّم الاحتياج', 'desc' => 'يزورك فريقنا لتقييم المكان وتحديد الخدمة المناسبة'],
                    ['icon' => 'fa-broom', 'title' => 'ننفذ الخدمة', 'desc' => 'يبدأ فريقنا المحترف بتنفيذ الخدمة بأعلى معايير الجودة'],
                    ['icon' => 'fa-star', 'title' => 'رضاك مضمون', 'desc' => 'نتأكد من رضاك الكامل قبل مغادرة الفريق']
                ]
            ],
            'areas' => [
                'badge' => 'مناطق الخدمة',
                'title' => 'نخدم <span class="text-gold">جميع أنحاء القصيم</span>',
                'desc' => 'نصلك أينما كنت في منطقة القصيم',
                'items' => [
                    ['title' => 'بريدة', 'desc' => 'العاصمة الرئيسية', 'icon' => '🏙️'],
                    ['title' => 'عنيزة', 'desc' => 'مدينة الورود', 'icon' => '🌆'],
                    ['title' => 'الرس', 'desc' => 'المدينة التاريخية', 'icon' => '🏘️'],
                    ['title' => 'البكيرية', 'desc' => 'المدينة الزراعية', 'icon' => '🏡'],
                    ['title' => 'المذنب', 'desc' => 'مدينة النخيل', 'icon' => '🌿'],
                    ['title' => 'البدائع', 'desc' => 'المدينة الحديثة', 'icon' => '🏗️'],
                    ['title' => 'رياض الخبراء', 'desc' => 'المدينة الجميلة', 'icon' => '🌄'],
                    ['title' => 'عيون الجواء', 'desc' => 'مدينة العيون', 'icon' => '💧'],
                    ['title' => 'الشماسية', 'desc' => 'مدينة التراث', 'icon' => '⭐']
                ]
            ],
            'cta' => [
                'title' => 'جاهز لمنزل نظيف كالفندق؟',
                'desc' => 'تواصل معنا الآن واحصل على عرض سعر مجاني خلال دقائق',
                'buttons' => [
                    ['text' => 'اطلب الخدمة الآن', 'link' => '#request-modal', 'show' => true, 'icon' => 'fa-calendar-check', 'class' => 'btn-gold'],
                    ['text' => 'تواصل واتساب', 'link' => 'https://wa.me/966550000000', 'show' => true, 'icon' => 'fab fa-whatsapp', 'class' => 'btn-whatsapp'],
                    ['text' => 'اتصل الآن', 'link' => 'tel:0550000000', 'show' => true, 'icon' => 'fa-phone', 'class' => 'btn-white']
                ]
            ]
        ];

        $contactSettings = [
            'phone' => '0550000000',
            'whatsapp' => '966550000000',
            'email' => 'info@alostora.com',
            'address' => 'بريدة، منطقة القصيم، المملكة العربية السعودية',
            'hours' => 'السبت - الخميس: 7ص - 10م',
            'waMsg' => 'السلام عليكم، أود الاستفسار عن خدمات التنظيف',
            'facebook' => '#',
            'twitter' => '#',
            'instagram' => '#',
            'tiktok' => '#',
            'snapchat' => '#'
        ];

        $seoSettings = [
            'seoSite' => 'الأسطورة رونق قلب الخليج',
            'seoTitle' => 'الأسطورة رونق قلب الخليج | شركة تنظيف احترافية في القصيم',
            'seoDesc' => 'الأسطورة رونق قلب الخليج - شركة تنظيف احترافية في القصيم. خدمات تنظيف منازل وفلل وشقق وسجاد وكنب ومجالس بأعلى جودة وأفضل الأسعار في بريدة وعنيزة والرس.',
            'seoKeys' => 'شركة تنظيف بالقصيم, تنظيف منازل بالقصيم, تنظيف فلل بالقصيم, تنظيف كنب, تنظيف سجاد, شركة تنظيف ببريدة',
            'seoGA' => '',
            'seoPx' => '',
            'seoHead' => ''
        ];

        Setting::updateOrCreate(['key' => 'homeSettings'], ['value' => $homeSettings]);
        Setting::updateOrCreate(['key' => 'contactSettings'], ['value' => $contactSettings]);
        Setting::updateOrCreate(['key' => 'seoSettings'], ['value' => $seoSettings]);
    }
}
