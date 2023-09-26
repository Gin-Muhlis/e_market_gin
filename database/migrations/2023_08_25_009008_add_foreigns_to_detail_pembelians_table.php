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
        Schema::table('detail_pembelians', function (Blueprint $table) {
            $table
                ->foreign('pembelian_id')
                ->references('id')
                ->on('pembelians')
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
        Schema::table('detail_pembelians', function (Blueprint $table) {
            $table->dropForeign(['pembelian_id']);
            $table->dropForeign(['barang_id']);
        });
    }
};
