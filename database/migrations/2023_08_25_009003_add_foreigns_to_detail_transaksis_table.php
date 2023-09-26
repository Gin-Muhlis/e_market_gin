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
        Schema::table('detail_transaksis', function (Blueprint $table) {
            $table
                ->foreign('transaksi_id')
                ->references('id')
                ->on('transaksis')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');

            $table
                ->foreign('jenis_pembayaran_id')
                ->references('id')
                ->on('jenis_pembayarans')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('detail_transaksis', function (Blueprint $table) {
            $table->dropForeign(['transaksi_id']);
            $table->dropForeign(['jenis_pembayaran_id']);
        });
    }
};
