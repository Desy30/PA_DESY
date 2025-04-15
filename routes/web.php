<?php
use App\Http\Controllers\PetaniController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('index', [PetaniController::class, 'index'])->name('index');


