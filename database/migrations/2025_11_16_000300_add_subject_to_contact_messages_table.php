<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migration untuk menambahkan kolom 'subject' ke tabel contact_messages
 * 
 * Gunanya: Menyimpan judul/subject dari pesan kontak yang dikirim.
 */
return new class extends Migration {
    /**
     * Menambahkan kolom subject ke tabel contact_messages
     */
    public function up(): void
    {
        Schema::table('contact_messages', function (Blueprint $table) {
            // Tambahkan kolom subject setelah kolom message
            // nullable=true karena subject optional
            $table->string('subject')->nullable()->after('message');
        });
    }

    /**
     * Rollback: Hapus kolom subject dari tabel contact_messages
     */
    public function down(): void
    {
        Schema::table('contact_messages', function (Blueprint $table) {
            $table->dropColumn('subject');
        });
    }
};
