<?php
require_once __DIR__ . '/settings.php';

use Singleton\Settings;

$settings = Settings::get();

$settings->number = 123;
$settings->text = "Hello";
$settings->flag = true;

echo "<pre>";
echo "number: {$settings->number}\n";
echo "text: {$settings->text}\n";
echo "flag: " . ($settings->flag ? 'true' : 'false');
echo "</pre>";
