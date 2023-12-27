<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\RusakDalam;

class Barang extends Model
{
    use HasFactory;
    protected $table = 'barangs';
    protected $primaryKey = 'id_barang';
    protected $fillable = ['id_barang','nama_barang','kode_barang','satuan','jumlah','id_kategori'];

    public function rusak_dalams()
    {
        return $this->hasMany(RusakDalam::class, 'id_barang');
    }
}
