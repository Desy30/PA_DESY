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
        Schema::create('kategori', function (Blueprint $table) {
            $table->uuid('id')->primary()->unique();
            $table->string('nama_kategori');
            $table->string('tipe_form')->default('default');
            $table->enum('jenis_kategori', ['pemasukan', 'pengeluaran']);
            $table->boolean('is_pengiriman')->default(false);
            $table->string('deskripsi');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kategori');
    }
};
