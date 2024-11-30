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
        Schema::table('outdoor_items', function (Blueprint $table) {
            $table->string('kategori')->nullable()->after('stok'); // Menambahkan kolom kategori setelah kolom item_name
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('outdoor_items', function (Blueprint $table) {
            $table->dropColumn('kategori');
        });
    }
};
