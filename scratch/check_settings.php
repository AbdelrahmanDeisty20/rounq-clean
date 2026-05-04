<?php
require __DIR__.'/../vendor/autoload.php';
$app = require_once __DIR__.'/../bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\Setting;

$setting = Setting::where('key', 'homeSettings')->first();
if ($setting) {
    echo "Key: " . $setting->key . "\n";
    echo "Value Length: " . strlen($setting->value) . "\n";
    echo "Value Preview: " . substr($setting->value, 0, 100) . "...\n";
    echo "Full JSON: " . $setting->value . "\n";
} else {
    echo "Setting not found\n";
}
