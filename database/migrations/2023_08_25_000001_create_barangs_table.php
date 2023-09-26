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
        Schema::create('barangs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('kode_barang', 50);
            $table->string('nama_barang', 100);
            $table->string('satuan', 10);
            $table->double('harga_jual');
            $table->integer('stok');
            $table->integer('ditarik');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('produk_id');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barangs');
    }
};
