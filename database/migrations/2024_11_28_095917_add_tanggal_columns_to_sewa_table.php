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
        Schema::table('sewa', function (Blueprint $table) {
            $table->date('tanggal_pemesanan')->nullable(); // Menambahkan kolom tanggal pemesanan
            $table->date('tanggal_pengembalian')->nullable(); // Menambahkan kolom tanggal pengembalian
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sewa', function (Blueprint $table) {
            $table->dropColumn('tanggal_pemesanan');
            $table->dropColumn('tanggal_pengembalian');
        });
    }
};
