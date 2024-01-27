<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangMasuk extends Model
{
    use HasFactory;
    protected $table = 'barang_masuks';
    protected $primaryKey = 'id_barang_masuk';
    protected $fillable = ['id_barang','jumlah_masuk','status'];
    public $timestamps = true;
}
