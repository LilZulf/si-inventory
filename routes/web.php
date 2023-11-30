<?php

use App\Http\Controllers\KategoriController;
use Illuminate\Support\Facades\Route;

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

Route::get('/kategori',[KategoriController::class, 'index']);
Route::get('/kategori/tambah',[KategoriController::class,'Tambah']);
Route::post('/kategori/tambah',[KategoriController::class,'Create']);
Route::get('/kategori/edit/{id}',[KategoriController::class,'Rubah']);
Route::put('/kategori/edit/{id}',[KategoriController::class, 'Edit']);
Route::get('/kategori/delete/{id}',[KategoriController::class, 'Delete']);
