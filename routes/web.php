<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\PjController;
use App\Http\Controllers\RuangController;
use App\Http\Controllers\KategoriController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\BarangMasukController;
use App\Http\Controllers\BarangKeluarController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\BarangRusakDalamController;
use App\Http\Controllers\BarangRusakLuarController;
use App\Http\Controllers\LaporanController;

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

//PJ
Route::get('/pj', [PjController::class, 'index']);
Route::get('/pj/tambah', [PjController::class, 'tambah']);
Route::post('/pj/tambah', [PjController::class, 'create']);
Route::get('/pj/edit/{id}', [PjController::class, 'updatePage']);
Route::put('/pj/update/{id}', [PjController::class, 'update']);
Route::delete('/pj/delete/{id}', [PjController::class, 'destroy']);

//Barang
Route::get('/barang', [BarangController::class, 'index']);
Route::get('/barang/tambah', [BarangController::class, 'tambah']);
Route::post('/barang/tambah', [BarangController::class, 'create']);
Route::get('/barang/edit/{id}', [BarangController::class, 'edit']);
Route::put('/barang/update/{id}', [BarangController::class, 'editproses']);
Route::get('/barang/delete/{id}', [BarangController::class, 'delete']);

Route::get('/barang/ruang', [BarangController::class, 'indexBarang']);
Route::get('/barang/ruang/info/{id}', [BarangController::class, 'infoBarang']);
Route::get('/barang/qr/{id}', [BarangController::class, 'tampilQr']);
Route::get('/barang/ruang/kembalikan/{id}', [BarangController::class, 'kembalikan']);

Route::get('/barang/masuk', [BarangMasukController::class, 'index']);
Route::get('/barang/masuk/tambah', [BarangMasukController::class, 'tambah']);
Route::post('/barang/masuk/tambah', [BarangMasukController::class, 'create']);
Route::get('/barang/masuk/edit/{id}', [BarangMasukController::class, 'edit']);
Route::put('/barang/masuk/update/{id}', [BarangMasukController::class, 'editproses']);
Route::get('/barang/masuk/delete/{id}', [BarangMasukController::class, 'delete']);
Route::get('/barang/masuk/validasi/{id}', [BarangMasukController::class, 'validasi']);


Route::get('/barang/keluar', [barangKeluarController::class, 'index']);
Route::get('/barang/keluar/tambah', [barangKeluarController::class, 'tambah']);
Route::post('/barang/keluar/tambah', [barangKeluarController::class, 'create']);
Route::get('/barang/keluar/edit/{id}', [barangKeluarController::class, 'edit']);
Route::put('/barang/keluar/update/{id}', [barangKeluarController::class, 'editproses']);
Route::get('/barang/keluar/delete/{id}', [barangKeluarController::class, 'delete']);
Route::get('/barang/keluar/validasi/{id}', [barangKeluarController::class, 'validasi']);


Route::get('/kategori',[KategoriController::class, 'index']);
Route::get('/kategori/tambah',[KategoriController::class,'Tambah']);
Route::post('/kategori/tambah',[KategoriController::class,'Create']);
Route::get('/kategori/edit/{id}',[KategoriController::class,'Rubah']);
Route::put('/kategori/edit/{id}',[KategoriController::class, 'Edit']);
Route::get('/kategori/delete/{id}',[KategoriController::class, 'Delete']);

Route::get('/peminjaman', [PeminjamanController::class, 'index']);
Route::get('/peminjaman/tambah', [PeminjamanController::class, 'tambah']);
Route::post('/peminjaman/tambah', [PeminjamanController::class, 'create']);
Route::get('/peminjaman/edit/{id}', [PeminjamanController::class, 'edit']);
Route::put('/peminjaman/update/{id}', [PeminjamanController::class, 'editproses']);
Route::get('/peminjaman/delete/{id}', [PeminjamanController::class, 'delete']);
Route::get('/peminjaman/pinjamkan/{id}', [PeminjamanController::class, 'pinjamkan']);
Route::get('/peminjaman/kembalikan/{id}', [PeminjamanController::class, 'kembalikan']);

Route::get('/admin',[AdminController::class, 'index']);
Route::get('/admin/tambah',[AdminController::class, 'tambah']);
Route::post('/admin/tambah',[AdminController::class, 'create']);
Route::get('/admin/edit/{id}',[AdminController::class, 'editIndex']);
Route::put('/admin/edit/{id}',[AdminController::class, 'edit']);
Route::get('/admin/delete/{id}',[AdminController::class, 'delete']);

//Barang Rusak
Route::get('/rusak/dalam', [BarangRusakDalamController::class, 'index']);
Route::get('/rusak/dalam/tambah', [BarangRusakDalamController::class, 'tambah']);
Route::post('/rusak/dalam/tambah', [BarangRusakDalamController::class, 'create']);
Route::get('/rusak/dalam/edit/{id}', [BarangRusakDalamController::class, 'updatePage']);
Route::put('/rusak/dalam/update/{id}', [BarangRusakDalamController::class, 'update']);
Route::get('/rusak/dalam/delete/{id}', [BarangRusakDalamController::class, 'delete']);
Route::get('/rusak/dalam/validasi/{id}', [BarangRusakDalamController::class, 'validasi']);
Route::post('/rusak/dalam/saveStatus', [BarangRusakDalamController::class,'changeStatus']);

Route::get('/rusak/luar', [BarangRusakLuarController::class, 'index']);
Route::get('/rusak/luar/tambah', [BarangRusakLuarController::class, 'tambah']);
Route::post('/rusak/luar/tambah', [BarangRusakLuarController::class, 'create']);
Route::get('/rusak/luar/edit/{id}', [BarangRusakLuarController::class, 'updatePage']);
Route::put('/rusak/luar/update/{id}', [BarangRusakLuarController::class, 'update']);
Route::get('/rusak/luar/delete/{id}', [BarangRusakLuarController::class, 'delete']);
Route::get('/rusak/luar/validasi/{id}', [BarangRusakLuarController::class, 'validasi']);
Route::post('/rusak/luar/saveStatus', [BarangRusakLuarController::class,'changeStatus']);

Route::get('/laporan/rusakDalam', [LaporanController::class, 'rusakDalam']);
Route::post('/laporan/rusakDalam', [LaporanController::class, 'prosesLaporanRusakDalam']);
Route::get('/laporan/rusakLuar', [LaporanController::class, 'rusakLuar']);
Route::post('/laporan/rusakLuar', [LaporanController::class, 'prosesLaporanRusakLuar']);
Route::get('/laporan/barangMasuk', [LaporanController::class, 'barangMasuk']);
Route::post('/laporan/barangMasuk', [LaporanController::class, 'prosesLaporanBarangMasuk']);
Route::get('/laporan/barangKeluar', [LaporanController::class, 'barangKeluar']);
Route::post('/laporan/barangKeluar', [LaporanController::class, 'prosesLaporanBarangKeluar']);
Route::get('/laporan/peminjaman', [LaporanController::class, 'peminjaman']);
Route::post('/laporan/peminjaman', [LaporanController::class, 'prosesLaporanPeminjaman']);
Route::get('/laporan/barangRuangan', [LaporanController::class, 'barangRuangan']);
Route::post('/laporan/barangRuangan', [LaporanController::class, 'prosesLaporanBarangRuangan']);