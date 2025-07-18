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
        Schema::create('transaksi_sawit_detail', function (Blueprint $table) {
            $table->uuid('id')->primary()->unique();
            $table->uuid('id_transaksi')->nullable();
            $table->double('bruto')->nullable();
            $table->double('tara')->nullable();
            $table->double('netto')->nullable();
            $table->double('potongan')->nullable();
            $table->double('berat_bersih')->nullable();
            $table->double('harga')->nullable();
            $table->string('surat_pengantar')->nullable();
            $table->string('bon')->nullable();
            $table->string('status_pengiriman')->default('Belum Terkirim');
            $table->timestamps();
            $table->foreign('id_transaksi')->references('id')->on('transaksi');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksi_sawit_detail');
    }
};
