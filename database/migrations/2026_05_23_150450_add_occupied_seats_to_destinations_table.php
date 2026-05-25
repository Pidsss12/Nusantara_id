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
        Schema::table('destinations', function (Blueprint $table) {
            // Menambahkan kolom occupied_seats dengan tipe string dan boleh kosong (nullable)
            $table->string('occupied_seats')->nullable()->after('description');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('destinations', function (Blueprint $table) {
            // Menghapus kembali kolom jika migration di-rollback
            $table->dropColumn('occupied_seats');
        });
    }
};