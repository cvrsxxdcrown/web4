<?php
session_start();

$image = imagecreatefromjpeg("noise.jpg");

$width = imagesx($image);
$height = imagesy($image);

$color = imagecolorallocate($image, 0, 0, 0);

$fonts = glob(__DIR__ . "/fonts/*.ttf");

$length = rand(5, 6);
$chars = 'ABCDEFGHJKLMNPQRSTUVWXYZ23456789';
$text = '';

for ($i = 0; $i < $length; $i++) {
    $text .= $chars[rand(0, strlen($chars) - 1)];
}

$_SESSION['captcha'] = $text;

$x = 20;
$y = 35;

for ($i = 0; $i < strlen($text); $i++) {
    $fontSize = rand(18, 30);
    $angle = rand(-25, 25);
    $font = $fonts[array_rand($fonts)];

    imagettftext(
        $image,
        $fontSize,
        $angle,
        $x,
        $y,
        $color,
        $font,
        $text[$i]
    );

    $x += 40;
}

header("Content-Type: image/jpeg");
imagejpeg($image, null, 50);
imagedestroy($image);
