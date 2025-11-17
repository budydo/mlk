<?php

// Debug route untuk test service data dan image URLs
// Akses di: http://localhost:8000/debug-services

use Illuminate\Support\Facades\Route;
use App\Models\Service;

Route::get('/debug-services', function () {
    $services = Service::where('is_published', 1)->get();
    
    return view('debug.services', ['services' => $services]);
})->name('debug.services');
