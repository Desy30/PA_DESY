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
        Schema::create('transaksi_items', function (Blueprint $table) {
            $table->uuid('id')->primary()->unique();
            $table->uuid('id_transaksi');
            $table->uuid('id_barang');
            $table->double('harga');
            $table->double('jumlah');
            $table->string('metode_pembayaran');
            $table->timestamps();

            $table->foreign('id_transaksi')->references('id')->on('transaksi');
            $table->foreign('id_barang')->references('id')->on('barang');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksi_items');
    }
};
