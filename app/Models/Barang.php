<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;
    protected $table = 'barangs';
    protected $primaryKey = 'id_barang';
    protected $fillable = ['id_barang','nama_barang','kode_barang','tahun_pengadaan','id_ruangan','id_kategori'];
}
