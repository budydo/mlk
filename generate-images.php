<?php

// Script untuk generate placeholder gambar lokal

$colors = [
    'amdal' => ['rgb' => [59, 130, 246], 'hex' => '#3B82F6'],
    'ukl' => ['rgb' => [34, 197, 94], 'hex' => '#22C55E'],
    'pemberdayaan' => ['rgb' => [139, 92, 246], 'hex' => '#8B5CF6'],
    'restorasi' => ['rgb' => [16, 185, 129], 'hex' => '#10B981'],
    'transportasi' => ['rgb' => [245, 158, 11], 'hex' => '#F59E0B'],
    'lingkungan' => ['rgb' => [6, 182, 212], 'hex' => '#06B6D4'],
    'konsultasi' => ['rgb' => [236, 72, 153], 'hex' => '#EC4899'],
    'pemantauan' => ['rgb' => [20, 184, 166], 'hex' => '#14B8A6'],
    'riset' => ['rgb' => [99, 102, 241], 'hex' => '#6366F1'],
    'pelatihan' => ['rgb' => [249, 115, 22], 'hex' => '#F97316'],
];

$services = [
    ['slug' => 'amdal-kajian-dampak', 'title' => 'AMDAL', 'color' => 'amdal'],
    ['slug' => 'ukl-upl', 'title' => 'UKL-UPL', 'color' => 'ukl'],
    ['slug' => 'pemberdayaan-komunitas', 'title' => 'Pemberdayaan', 'color' => 'pemberdayaan'],
    ['slug' => 'restorasi-lahan', 'title' => 'Restorasi', 'color' => 'restorasi'],
    ['slug' => 'transportasi-manajemen-lalu-lintas', 'title' => 'Transportasi', 'color' => 'transportasi'],
    ['slug' => 'lingkungan-hidup-berkelanjutan', 'title' => 'Lingkungan', 'color' => 'lingkungan'],
    ['slug' => 'konsultasi-lingkungan', 'title' => 'Konsultasi', 'color' => 'konsultasi'],
    ['slug' => 'pemantauan-dampak', 'title' => 'Pemantauan', 'color' => 'pemantauan'],
    ['slug' => 'riset-dan-pengembangan', 'title' => 'Riset', 'color' => 'riset'],
    ['slug' => 'pelatihan-kapasitas', 'title' => 'Pelatihan', 'color' => 'pelatihan'],
];

$baseDir = __DIR__ . '/public/images/services';

foreach ($services as $service) {
    $colorInfo = $colors[$service['color']];
    
    // Create image
    $image = imagecreatetruecolor(800, 500);
    
    // Allocate colors
    $bgColor = imagecolorallocate($image, $colorInfo['rgb'][0], $colorInfo['rgb'][1], $colorInfo['rgb'][2]);
    $textColor = imagecolorallocate($image, 255, 255, 255);
    
    // Fill background
    imagefill($image, 0, 0, $bgColor);
    
    // Add text
    $font = __DIR__ . '/resources/fonts/arial.ttf'; // Default system font fallback
    $fontSize = 60;
    $text = $service['title'];
    
    // Get text bounding box
    $bbox = imagettfbbox($fontSize, 0, $font, $text);
    $textWidth = $bbox[2] - $bbox[0];
    $textHeight = $bbox[1] - $bbox[7];
    
    // Center text
    $x = (800 - $textWidth) / 2;
    $y = (500 + $textHeight) / 2;
    
    imagettftext($image, $fontSize, 0, $x, $y, $textColor, $font, $text);
    
    // Save image
    $filename = $baseDir . '/' . $service['slug'] . '.jpg';
    imagejpeg($image, $filename, 90);
    imagedestroy($image);
    
    echo "Generated: " . $filename . "\n";
}

echo "All images generated successfully!\n";
?>
