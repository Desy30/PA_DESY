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
        Schema::create('barang', function (Blueprint $table) {
            $table->uuid('id')->primary()->unique();
            $table->uuid('id_supplier')->nullable();
            $table->string('nama_barang');
            $table->double('stock_barang')->default(0);
            $table->string('harga_jual_barang');
            $table->string('harga_beli_barang');
            $table->timestamps();

            $table->foreign('id_supplier')->references('id')->on('supplier_pupuk');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barang');
    }
};
