<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('services', function (Blueprint $table) {
            // Tambahkan kolom cover_image dan icon jika belum ada
            if (!Schema::hasColumn('services', 'cover_image')) {
                $table->string('cover_image')->nullable();
            }
            if (!Schema::hasColumn('services', 'icon')) {
                $table->string('icon')->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('services', function (Blueprint $table) {
            // Hapus kolom yang ditambahkan
            $table->dropColumn(['cover_image', 'icon']);
        });
    }
};
