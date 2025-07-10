<?php

use App\Http\Controllers\BarangController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DokumentasiController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PemasukanController;
use App\Http\Controllers\PengeluaranController;
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\PengirimanController;
use App\Http\Controllers\PetaniController;
use App\Http\Controllers\PksController;
use App\Http\Controllers\PupukController;
use App\Models\KaryawanModel;
use App\Models\Pemasukan;
use App\Models\SupplierPupukModel;
use Illuminate\Support\Facades\Route;


Route::middleware('auth')->group(function () {
    Route::post('logout', action: [LoginController::class, 'logout'])->name('logout');

    Route::prefix("dashboard")->group(function () {
        Route::get('', [DashboardController::class, 'index'])->name('dashboard');
    });

    Route::prefix("petani")->group(function () {
        Route::get('', [PetaniController::class, 'index'])->name('petani');
        Route::get('create', [PetaniController::class, 'create'])->name('petani.create');
        Route::post('store', [PetaniController::class, 'store'])->name('petani.store');
        // Route untuk form edit (GET)
        Route::get('/petani/{id}/edit', [PetaniController::class, 'edit'])->name('petani.edit');
        // Route untuk update data petani (PUT)
        Route::put('/petani/{id}', [PetaniController::class, 'update'])->name('petani.update');
        Route::get('/petani/{id}', [PetaniController::class, 'show'])->name('petani.show');
        Route::delete('/petani/{id}', [PetaniController::class, 'destroy'])->name('petani.destroy');
    });


    Route::prefix("pks")->group(function () {
        Route::get('', [PksController::class, 'index'])->name('pks');
        Route::get('create', [PksController::class, 'create'])->name('pks.create');
        Route::post('store', [PksController::class, 'store'])->name('pks.store');
        // Route untuk form edit (GET)
        Route::get('{id}/edit', [PksController::class, 'edit'])->name('pks.edit');
        // Route untuk update data pks (PUT)
        Route::put('{id}', [PksController::class, 'update'])->name('pks.update');
        //Route untuk melihat show data yang diinput
        Route::get('/pks/{id}', [PksController::class, 'show'])->name('pks.show');
        // Route untuk menghapus data pks (DELETE)
        Route::delete('{id}', [PksController::class, 'destroy'])->name('pks.destroy');
    });



    Route::prefix("pupuk")->group(function () {
        Route::get('', [PupukController::class, 'index'])->name('pupuk');
        Route::get('create', [PupukController::class, 'create'])->name('pupuk.create');
        Route::post('store', [PupukController::class, 'store'])->name('pupuk.store');
        Route::get('{id}/edit', [PupukController::class, 'edit'])->name('pupuk.edit');
        Route::put('{id}', [PupukController::class, 'update'])->name('pupuk.update');
        Route::get('/pupuk/{id}', [PupukController::class, 'show'])->name('pupuk.show');
        Route::delete('{id}', [PupukController::class, 'destroy'])->name('pupuk.destroy'); // DELETE route
    });


    Route::prefix('barang')->group(function () {
        // Menampilkan daftar barang
        Route::get('', [BarangController::class, 'index'])->name('barang');

        // Menampilkan form untuk menambah barang
        Route::get('create', [BarangController::class, 'create'])->name('barang.create');

        // Menyimpan data barang
        Route::post('store', [BarangController::class, 'store'])->name('barang.store');

        // Menampilkan form untuk mengedit barang
        Route::get('{id}/edit', [BarangController::class, 'edit'])->name('barang.edit');

        // Menampilkan show barang
        Route::get('{id}/show', [BarangController::class, 'show'])->name('barang.show');

        // Memperbarui data barang
        Route::put('{id}', [BarangController::class, 'update'])->name('barang.update');

        // Menghapus data barang
        Route::delete('{id}', [BarangController::class, 'destroy'])->name('barang.destroy');
    });



    Route::prefix('pemasukan')->group(function () {
        Route::get('', [PemasukanController::class, 'index'])->name('pemasukan');
        Route::get('create', [PemasukanController::class, 'create'])->name('pemasukan.create');
        Route::get('{id}/edit', [PemasukanController::class, 'edit'])->name('pemasukan.edit');
        Route::get('{id}/show', [PemasukanController::class, 'show'])->name('pemasukan.show');
        Route::post('store', [PemasukanController::class, 'store'])->name('pemasukan.store');
    });



    Route::prefix('pengeluaran')->group(function () {
        Route::get('', [PengeluaranController::class, 'index'])->name('pengeluaran');
        Route::get('create', [PengeluaranController::class, 'create'])->name('pengeluaran.create')->middleware('role:kasir');
        Route::get('{id}/edit', [PengeluaranController::class, 'edit'])->name('pengeluaran.edit');
        Route::get('{id}/show', [PengeluaranController::class, 'show'])->name('pengeluaran.show');
        Route::post('store', [PengeluaranController::class, 'store'])->name('pengeluaran.store');
    });
    Route::prefix('laporan')->group(function () {
        Route::get('', [LaporanController::class, 'index'])->name('laporan');
        Route::post('/laporan/filter', [LaporanController::class, 'filter'])->name('laporan.filter');
    });

    Route::prefix('kategori')->group(function () {
        Route::get('', [KategoriController::class, 'index'])->name('kategori');
        Route::get('/kategori/{id}/show', [KategoriController::class, 'show'])->name('kategori.show');

        Route::get('get-by-jenis', [KategoriController::class, 'getByJenis'])->name('kategori.get-by-jenis');
        Route::get('create', [KategoriController::class, 'create'])->name('kategori.create');
        Route::post('/kategori', [KategoriController::class, 'store'])->name('kategori.store');
        Route::get('{id}/edit', [KategoriController::class, 'edit'])->name('kategori.edit');
        Route::put('{id}', [KategoriController::class, 'update'])->name('kategori.update');
        Route::delete('{id}', [KategoriController::class, 'destroy'])->name('kategori.destroy');
    });

    Route::prefix('dokumentasi')->group(function () {
        Route::get('', [DokumentasiController::class, 'index'])->name('dokumentasi');
    });
    Route::prefix('pengguna')->group(function () {
        Route::get('', [PenggunaController::class, 'index'])->name('pengguna');
        Route::get('create', [PenggunaController::class, 'create'])->name('pengguna.create');
        Route::put('{id}/edit', [PenggunaController::class, 'edit'])->name('pengguna.edit');
        Route::post('', [PenggunaController::class, 'store'])->name('pengguna.store');
        Route::delete('{id}', [PenggunaController::class, 'destroy'])->name('pengguna.destroy');
    });



    Route::prefix('karyawan')->group(function () {
        Route::get('/', [KaryawanController::class, 'index'])->name('karyawan');
        Route::get('/create', [KaryawanController::class, 'create'])->name('karyawan.create');
        Route::post('/', [KaryawanController::class, 'store'])->name('karyawan.store');
        Route::get('/{id}/edit', [KaryawanController::class, 'edit'])->name('karyawan.edit');
        Route::put('/{id}', [KaryawanController::class, 'update'])->name('karyawan.update');
        Route::delete('/{id}', [KaryawanController::class, 'destroy'])->name('karyawan.destroy');
    });

    Route::prefix('pengiriman')->group(function () {
        Route::get('/', [PengirimanController::class, 'index'])->name('pengiriman');
        Route::get('/{id}/edit', [PengirimanController::class, 'edit'])->name('pengiriman.edit');
        Route::put('/{id}', [PengirimanController::class, 'update'])->name('pengiriman.update');
        Route::put('/update/show/{id}', [PengirimanController::class, 'updateShow'])->name('pengiriman.updateShow');
    });
});

Route::middleware('guest')->group(function () {
    Route::get('', [LoginController::class, 'loginPage'])->name('login');
    Route::post('login', [LoginController::class, 'login'])->name('login.process');
});
Route::middleware('auth')->group(function () {
    Route::get('/pengeluaran/invoice/{id}', [PengeluaranController::class, 'cetakInvoice'])->name('pengeluaran.invoice');
});

Route::middleware('auth')->group(function () {
    Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan');
    Route::get('/laporan/export', [LaporanController::class, 'exportPdf'])->name('laporan.export.pdf');
});
