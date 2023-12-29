<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Pj;
use App\Models\Barang;
use App\Models\Ruang;

class RusakDalam extends Model
{
    use HasFactory;
    protected $table = 'rusak_dalams';
    protected $primaryKey = 'id_rusak_dalam';
    protected $fillable = ['id_pj','id_barang','jumlah_rusak','id_ruangan','tanggal_rusak','status'];
    public $incrementing = true;

    public function pj()
    {
        return $this->belongsTo(Pj::class, 'id');
    }

    public function barangs()
    {
        return $this->belongsTo(Barang::class, 'id_barang');
    }

    public function ruangs()
    {
        return $this->belongsTo(Ruang::class, 'id');
    }
}
