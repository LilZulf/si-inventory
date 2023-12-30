<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Pj;
use App\Models\Barang;

class RusakRuangan extends Model
{
    use HasFactory;
    protected $table = 'rusak_ruangans';
    protected $primaryKey = 'id_rusak_luar';
    protected $fillable = ['id_pj','id_barang','jumlah_rusak','tanggal_rusak','status'];
    public $incrementing = true;

    public function pj()
    {
        return $this->belongsTo(Pj::class, 'id');
    }

    public function barangs()
    {
        return $this->belongsTo(Barang::class, 'id_barang');
    }
}
