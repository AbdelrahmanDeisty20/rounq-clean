<?php

use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

if (file_exists($maintenance = __DIR__.'/storage/framework/maintenance.php')) {
    require $maintenance;
}

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';

// Smart public path detection: Use 'public' folder if it exists, otherwise use root.
if (is_dir(__DIR__ . '/public/css')) {
    $app->usePublicPath(__DIR__ . '/public');
} else {
    $app->usePublicPath(__DIR__);
}

$app->handleRequest(Request::capture());