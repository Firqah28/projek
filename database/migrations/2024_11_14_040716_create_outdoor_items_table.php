<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('outdoor_items', function (Blueprint $table) {
        $table->id();
        $table->string('name'); // Nama barang
        $table->text('description'); // Deskripsi barang
        $table->decimal('price', 8, 2); // Harga barang
        $table->string('image')->nullable(); // Path gambar barang
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('outdoor_items');
    }
};
