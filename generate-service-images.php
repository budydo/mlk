<?php

$services = [
    ['slug' => 'ukl-upl', 'title' => 'UKL-UPL', 'color' => [34, 197, 94]],
    ['slug' => 'amdal-kajian-dampak', 'title' => 'AMDAL', 'color' => [59, 130, 246]],
    ['slug' => 'pemberdayaan-komunitas', 'title' => 'Pemberdayaan', 'color' => [139, 92, 246]],
    ['slug' => 'restorasi-lahan', 'title' => 'Restorasi', 'color' => [16, 185, 129]],
    ['slug' => 'transportasi-manajemen-lalu-lintas', 'title' => 'Transportasi', 'color' => [245, 158, 11]],
    ['slug' => 'lingkungan-hidup-berkelanjutan', 'title' => 'Lingkungan', 'color' => [6, 182, 212]],
    ['slug' => 'konsultasi-lingkungan', 'title' => 'Konsultasi', 'color' => [236, 72, 153]],
    ['slug' => 'pemantauan-dampak', 'title' => 'Pemantauan', 'color' => [20, 184, 166]],
    ['slug' => 'riset-dan-pengembangan', 'title' => 'Riset', 'color' => [99, 102, 241]],
    ['slug' => 'pelatihan-kapasitas', 'title' => 'Pelatihan', 'color' => [249, 115, 22]],
];

$basePath = __DIR__ . '/public/images/services';

// Create directory
if (!is_dir($basePath)) {
    mkdir($basePath, 0755, true);
}

foreach ($services as $service) {
    $image = imagecreatetruecolor(800, 500);
    
    // Allocate color
    $bgColor = imagecolorallocate($image, $service['color'][0], $service['color'][1], $service['color'][2]);
    $textColor = imagecolorallocate($image, 255, 255, 255);
    
    // Fill background
    imagefill($image, 0, 0, $bgColor);
    
    // Add text using built-in font
    $text = $service['title'];
    $textBox = imagettfbbox(60, 0, __DIR__ . '/resources/fonts/arial.ttf', $text);
    
    $textWidth = $textBox[2] - $textBox[0];
    $textHeight = $textBox[1] - $textBox[7];
    $x = (800 - $textWidth) / 2;
    $y = (500 + $textHeight) / 2;
    
    @imagettftext($image, 60, 0, $x, $y, $textColor, __DIR__ . '/resources/fonts/arial.ttf', $text);
    
    // Fallback if TTF not available - use imagestring
    if (!file_exists(__DIR__ . '/resources/fonts/arial.ttf')) {
        imagestring($image, 5, 300, 230, $text, $textColor);
    }
    
    $filepath = $basePath . '/' . $service['slug'] . '.jpg';
    imagejpeg($image, $filepath, 90);
    imagedestroy($image);
    
    echo "Generated: " . $filepath . "\n";
}

echo "All images generated successfully!\n";
?>
