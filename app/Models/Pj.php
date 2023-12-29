<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\RusakDalam;
use App\Helpers\HashHelper;

class Pj extends Model
{
    use HasFactory;
    protected $table = 'pj'; // Sesuaikan dengan nama tabel yang benar

    protected $fillable = [
        'nama_pj',
        'nip',
        'alamat',
        'jenis_kelamin',
        'email',
        'password',
    ];

    public static function createEncryptedPassword($password)
    {
        return HashHelper::encryptPassword($password);
    }

    public function rusak_dalams()
    {
        return $this->hasMany(RusakDalam::class, 'id_pj');
    }


}
