<?php
use App\Http\Controllers\PetaniController;
use Illuminate\Support\Facades\Route;

Route::prefix("petani")->group(function () {
    Route::get('', [PetaniController::class, 'index'])->name('petani');
    Route::get('create', [PetaniController::class, 'create'])->name('petani.create');
    Route::get('{id}/edit', [PetaniController::class, 'edit'])->name('petani.edit');
});
