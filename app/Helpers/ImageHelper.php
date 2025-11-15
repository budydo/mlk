<?php

// Helper untuk menangani image URL
// Jika URL sudah lengkap (http/https), gunakan sebagaimana adanya
// Jika path lokal, gunakan asset() helper

if (!function_exists('imageUrl')) {
    function imageUrl($path)
    {
        if (empty($path)) {
            return null;
        }
        
        // Jika sudah URL lengkap dengan protokol http/https
        if (strpos($path, 'http://') === 0 || strpos($path, 'https://') === 0) {
            return $path;
        }
        
        // Jika path lokal, gunakan asset()
        return asset($path);
    }
}
