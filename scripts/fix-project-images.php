<?php
// Skrip: scripts/fix-project-images.php
// Menjalankan di root proyek: php scripts/fix-project-images.php

require __DIR__ . '/../vendor/autoload.php';

$app = require_once __DIR__ . '/../bootstrap/app.php';

$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Project;
use Illuminate\Support\Facades\Http;

$dir = public_path('images/projects');
if (!is_dir($dir)) {
    mkdir($dir, 0755, true);
}

$projects = Project::orderBy('created_at', 'desc')->get();

echo "Total proyek: " . $projects->count() . "\n";

foreach ($projects as $project) {
    $need = false;
    $current = $project->cover_image;
    if (empty($current)) {
        $need = true;
        echo "[MISSING FIELD] ({$project->id}) {$project->title}\n";
    } else {
        $path = public_path($current);
        if (!file_exists($path)) {
            $need = true;
            echo "[FILE NOT FOUND] ({$project->id}) {$project->title} -> {$current}\n";
        }
    }

    if ($need) {
        // Tentukan keyword dari judul untuk mencari gambar yang relevan
        $keywords = preg_replace('/[^A-Za-z0-9 ]/', '', $project->title);
        $keywords = implode(',', array_slice(explode(' ', $keywords), 0, 4));
        if (empty($keywords)) {
            $keywords = 'environment,project';
        }

        // Coba unduh dari source.unsplash.com
        $urlUnsplash = "https://source.unsplash.com/800x500/?" . urlencode($keywords);
        $success = false;
        try {
            $resp = Http::timeout(30)->withoutVerifying()->get($urlUnsplash);
            if ($resp->successful()) {
                $imageBody = $resp->body();
                $success = true;
            } else {
                echo "  -> Unsplash gagal status: " . $resp->status() . "\n";
            }
        } catch (Exception $e) {
            echo "  -> Unsplash exception: " . $e->getMessage() . "\n";
        }

        // Jika Unsplash gagal, gunakan picsum.photos (fallback otomatis)
        if (! $success) {
            $seed = preg_replace('/[^A-Za-z0-9]/', '', ($project->slug ?: 'p' . $project->id));
            $urlPicsum = "https://picsum.photos/seed/" . urlencode($seed) . "/800/500";
            try {
                $resp2 = Http::timeout(30)->withoutVerifying()->get($urlPicsum);
                if ($resp2->successful()) {
                    $imageBody = $resp2->body();
                    $success = true;
                    echo "  -> Menggunakan fallback picsum.photos (seed={$seed})\n";
                } else {
                    echo "  -> Picsum gagal status: " . $resp2->status() . "\n";
                }
            } catch (Exception $e) {
                echo "  -> Picsum exception: " . $e->getMessage() . "\n";
            }
        }

        if ($success) {
            $filename = $project->slug ?: 'project-' . $project->id;
            // Pastikan nama file aman
            $filename = preg_replace('/[^A-Za-z0-9\-]/', '-', strtolower($filename));
            $filepath = $dir . DIRECTORY_SEPARATOR . $filename . '.jpg';
            file_put_contents($filepath, $imageBody);

            $dbPath = 'images/projects/' . $filename . '.jpg';
            $project->cover_image = $dbPath;
            $project->save();

            echo "  -> Downloaded and saved as {$dbPath}\n";
        } else {
            echo "  -> Gagal mengunduh gambar untuk proyek ini, sisakan fallback.\n";
        }
    }
}

echo "Selesai. Periksa direktori public/images/projects dan tabel projects.\n";
