<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    use HasFactory;
    protected $table = 'peminjamans';
    protected $primaryKey = 'id_peminjaman';
    protected $fillable = ['id_barang','jumlah_pinjam','id_ruang','peminjam','status'];
}
