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
        Schema::create('tampung_bayars', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('penjualan_id');
            $table->double('total');
            $table->double('terima');
            $table->double('kembali');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tampung_bayars');
    }
};
