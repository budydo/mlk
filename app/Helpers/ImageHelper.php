<?php

// Helper untuk menangani image URL
// Jika URL sudah lengkap (http/https), gunakan sebagaimana adanya
// Jika path lokal, gunakan asset() helper dengan fallback ke placeholder

if (!function_exists('imageUrl')) {
    function imageUrl($path)
    {
        // Jika path kosong, kembalikan null (view akan handle dengan gradient placeholder)
        if (empty($path)) {
            return null;
        }
        
        // Jika sudah URL lengkap dengan protokol http/https
        // Return URL eksternal langsung
        if (strpos($path, 'http://') === 0 || strpos($path, 'https://') === 0) {
            return $path;
        }
        
        // Jika path lokal yang disimpan di storage/app/public (mis. 'services/..'),
        // kembalikan URL lewat symlink public/storage
        // Format path lokal: 'services/nama-file.jpg'
        $storagePath = storage_path('app/public/' . ltrim($path, '/'));
        
        // Periksa apakah file benar-benar ada di storage
        if (file_exists($storagePath)) {
            return asset('storage/' . ltrim($path, '/'));
        }
        
        // Jika file tidak ada, cek apakah ada path lama (images/services/...)
        // untuk backward compatibility dengan gambar lama
        if (file_exists(public_path($path))) {
            return asset($path);
        }

        // Jika file tidak ditemukan sama sekali, kembalikan null
        // (view akan menampilkan placeholder gradient)
        return null;
    }
}
