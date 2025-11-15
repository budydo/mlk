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
        /**
         * Tambahkan kolom is_featured pada tabel projects untuk menandai proyek unggulan
         * yang akan ditampilkan pada halaman beranda.
         */
        Schema::table('projects', function (Blueprint $table) {
            $table->boolean('is_featured')->default(false)->after('is_published')->comment('Proyek unggulan yang ditampilkan di halaman beranda');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->dropColumn('is_featured');
        });
    }
};
