<?php

use App\Http\Controllers\RuangController;
use App\Http\Controllers\KategoriController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BarangController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('template');
});

// Ruangan
Route::get('/ruangan', [RuangController::class, 'index']);
Route::get('/ruangan/tambah', [RuangController::class, 'tambah']);
Route::post('/ruangan/tambah', [RuangController::class, 'create']);
Route::get('/ruangan/edit/{id}', [RuangController::class, 'updatePage']);
Route::put('/ruangan/update/{id}', [RuangController::class, 'update']);
Route::delete('/ruangan/delete/{id}', [RuangController::class, 'destroy']);
// Route::delete('/ruangan/delete/{id}', [RuangController::class, 'destroy'])->name('ruangan.delete');


Route::get('/barang', [BarangController::class, 'index']);
Route::get('/barang/tambah', [BarangController::class, 'tambah']);
Route::post('/barang/tambah', [BarangController::class, 'create']);
Route::get('/barang/edit/{id}', [BarangController::class, 'edit']);
Route::put('/barang/update/{id}', [BarangController::class, 'editproses']);
Route::get('/barang/delete/{id}', [BarangController::class, 'delete']);
Route::get('/kategori',[KategoriController::class, 'index']);
Route::get('/kategori/tambah',[KategoriController::class,'Tambah']);
Route::post('/kategori/tambah',[KategoriController::class,'Create']);
Route::get('/kategori/edit/{id}',[KategoriController::class,'Rubah']);
Route::put('/kategori/edit/{id}',[KategoriController::class, 'Edit']);
Route::get('/kategori/delete/{id}',[KategoriController::class, 'Delete']);
