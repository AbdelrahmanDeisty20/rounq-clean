<?php
$logFile = 'storage/logs/laravel.log';
if (file_exists($logFile)) {
    $content = file($logFile);
    $lastLines = array_slice($content, -20);
    echo "<h2>آخر الأخطاء المسجلة في لارافيل:</h2>";
    echo "<pre style='background:#f4f4f4; pading:15px; border:1px solid #ccc; white-space: pre-wrap;'>";
    foreach ($lastLines as $line) {
        echo htmlspecialchars($line);
    }
    echo "</pre>";
} else {
    echo "لا يوجد ملف سجل أخطاء (laravel.log) حتى الآن.";
}
?>
