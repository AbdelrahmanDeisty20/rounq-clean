<?php
header('Content-Type: text/html; charset=utf-8');

function check($title, $condition, $errorMsg) {
    echo "<strong>$title:</strong> ";
    if ($condition) {
        echo "<span style='color:green'>✅ ناجح</span><br>";
    } else {
        echo "<span style='color:red'>❌ فشل - $errorMsg</span><br>";
    }
}

echo "<h2>فحص توافق الاستضافة مع لارافيل</h2>";

// 1. PHP Version
$currentV = phpversion();
check("إصدار PHP الحالي هو ($currentV)", version_compare($currentV, '8.3.0', '>='), "المطلوب 8.3.0 على الأقل حسب ملف composer.json");

// 2. Env File
check("ملف الـ .env", file_exists('.env'), "ملف .env غير موجود في المجلد الرئيسي");

// 3. Permissions
check("صلاحيات مجلد Storage", is_writable('storage'), "مجلد storage غير قابل للكتابة (اعمله 775 أو 777)");
check("صلاحيات مجلد Bootstrap Cache", is_writable('bootstrap/cache'), "مجلد bootstrap/cache غير قابل للكتابة");

// 4. Extensions
$exts = ['openssl', 'pdo', 'mbstring', 'tokenizer', 'xml', 'ctype', 'json', 'bcmath'];
foreach($exts as $ext) {
    check("إضافة $ext", extension_loaded($ext), "إضافة $ext غير مفعلة على السيرفر");
}

// 5. DB Connection (Manual Parse Env)
if (file_exists('.env')) {
    $env = file_get_contents('.env');
    preg_match('/DB_HOST=(.*)/', $env, $host);
    preg_match('/DB_DATABASE=(.*)/', $env, $db);
    preg_match('/DB_USERNAME=(.*)/', $env, $user);
    preg_match('/DB_PASSWORD=(.*)/', $env, $pass);
    
    $h = trim($host[1] ?? '127.0.0.1');
    $d = trim($db[1] ?? '');
    $u = trim($user[1] ?? '');
    $p = trim($pass[1] ?? '');
    
    try {
        $pdo = new PDO("mysql:host=$h;dbname=$d", $u, $p);
        check("الاتصال بقاعدة البيانات", true, "");
    } catch (PDOException $e) {
        check("الاتصال بقاعدة البيانات", false, $e->getMessage());
    }
}

echo "<p style='margin-top:20px'><i>لو كل اللي فوق أخضر والموقع لسه مش شغال، راجع ملف الـ htaccess أو الـ PHP Version تاني.</i></p>";
?>
