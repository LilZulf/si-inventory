<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangKeluar extends Model
{
    use HasFactory;
    protected $table = 'barang_keluars';
    protected $primaryKey = 'id_barang_keluar';
    protected $fillable = ['id_barang','jumlah_keluar','id_ruang','status'];
}
