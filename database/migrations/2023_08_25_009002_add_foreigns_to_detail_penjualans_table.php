<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('detail_penjualans', function (Blueprint $table) {
            $table
                ->foreign('penjualan_id')
                ->references('id')
                ->on('penjualans')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');

            $table
                ->foreign('barang_id')
                ->references('id')
                ->on('barangs')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('detail_penjualans', function (Blueprint $table) {
            $table->dropForeign(['penjualan_id']);
            $table->dropForeign(['barang_id']);
        });
    }
};
