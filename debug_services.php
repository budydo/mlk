<?php
// Debug script untuk melihat data services di database

require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make('Illuminate\Contracts\Console\Kernel');
$kernel->bootstrap();

use App\Models\Service;

// Ambil semua services yang dipublikasikan
$services = Service::where('is_published', 1)->get();

echo "=== PUBLISHED SERVICES ===\n";
foreach ($services as $service) {
    echo "\nService ID: {$service->id}\n";
    echo "Title: {$service->title}\n";
    echo "Slug: {$service->slug}\n";
    echo "Image Path: {$service->image_path}\n";
    echo "Is Published: {$service->is_published}\n";
    echo "Created At: {$service->created_at}\n";
}

echo "\n=== TOTAL: " . $services->count() . " services ===\n";
