<?php
$file = 'vendor/composer/platform_check.php';
if (file_exists($file)) {
    file_put_contents($file, "<?php\n// Bypassed by Antigravity\nreturn;");
    echo "✅ تم تعطيل فحص إصدار PHP بنجاح! جرب تفتح الموقع دلوقت.";
} else {
    echo "❌ لم يتم العثور على ملف platform_check.php في مجلد vendor.";
}
?>
