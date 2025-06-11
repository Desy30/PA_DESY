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
        Schema::create('supplier_pupuk', function (Blueprint $table) {
            $table->uuid('id')->primary()->unique();
            $table->string('nama_supplier');
            $table->string('nomor_telepon_supplier');
            $table->string('alamat_supplier');
            $table->string('nomor_rekening_supplier');
            $table->string('keterangan');

            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('supplier_pupuk');
    }
};
