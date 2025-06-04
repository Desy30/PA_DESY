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
        Schema::create('transaksi', function (Blueprint $table) {
            $table->uuid('id')->primary()->unique();
            $table->uuid('id_petani')->nullable();
            $table->uuid('id_pks')->nullable();
            $table->uuid('id_supplier_pupuk')->nullable();
            $table->uuid('id_kategori')->nullable();
            $table->uuid('id_barang')->nullable();
            $table->uuid('id_user')->nullable();
            $table->double('total');
            $table->date('tanggal');
            $table->string(column: 'status')->nullable();
            $table->enum('metode_pembayaran', ['Cash', 'Transfer']);
            $table->string('bukti_transaksi')->nullable();
            $table->string('keterangan')->nullable();
            $table->timestamps();

            $table->foreign('id_petani')->references('id')->on('petani');
            $table->foreign('id_pks')->references('id')->on('pks');
            $table->foreign('id_supplier_pupuk')->references('id')->on('supplier_pupuk');
            $table->foreign('id_kategori')->references('id')->on('kategori')->onDelete('cascade');
            $table->foreign('id_barang')->references('id')->on('barang');
            $table->foreign('id_user')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksi');
    }
};
