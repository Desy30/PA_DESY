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
        Schema::create('transaksi_gaji_detail', function (Blueprint $table) {
            $table->uuid('id')->primary()->unique();
            $table->uuid('id_transaksi');
            $table->uuid('id_karyawan');
            $table->date('periode');
            $table->double('tunjangan')->nullable();
            $table->double('potongan_gaji');
            $table->text('keterangan')->nullable();
            $table->foreign(columns: 'id_transaksi')->references('id')->on('transaksi');
            $table->foreign(columns: 'id_karyawan')->references('id')->on('karyawan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksi_gaji_detail');
    }
};
