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
        if (!Schema::hasColumn('sewa', 'total_harga')) {
            Schema::table('sewa', function (Blueprint $table) {
                $table->decimal('total_harga', 10, 2)->after('jumlah_barang');
            });
        }
    }

    public function down()
    {
        if (Schema::hasColumn('sewa', 'total_harga')) {
            Schema::table('sewa', function (Blueprint $table) {
                $table->dropColumn('total_harga');
            });
        }
    }
};
