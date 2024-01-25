<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ruang extends Model
{
    use HasFactory;

    public function pj()
    {
        return $this->belongsTo(Pj::class, 'id_pj', 'id');
    }

    protected $fillable = [
        'kode_ruangan',
        'ruangan',
        'id_pj',
        'keterangan'
    ];
    public $timestamps = true;

    public function rusak_dalams()
    {
        return $this->hasMany(RusakDalam::class, 'id_ruangan');
    }
}
