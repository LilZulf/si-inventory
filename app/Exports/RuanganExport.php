<?php

namespace App\Exports;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;

class RuanganExport implements FromView
{
    use Exportable;
    private $pilihRuangan;
    public function __construct(int $pilihRuangan)
    {
        $this->pilihRuangan = $pilihRuangan;
    }
    
    public function view():View
    {
        $data = DB::table('barang_keluars')
            ->join('barangs', 'barang_keluars.id_barang', '=', 'barangs.id_barang')
            ->join('ruangs', 'barang_keluars.id_ruang', '=', 'ruangs.id')
            ->leftJoin('rusak_dalams', function ($join) {
                $join->on('barang_keluars.id_barang', '=', 'rusak_dalams.id_barang')
                    ->where('rusak_dalams.status', '=', 2); 
            })
            ->select(
                'ruangs.ruangan',
                'barangs.nama_barang',
                'barang_keluars.jumlah_keluar',
                'rusak_dalams.jumlah_rusak',
                'rusak_dalams.status',
                'barang_keluars.status as barang_keluar_status'
            )
            ->where('barang_keluars.id_ruang', '=', $this->pilihRuangan)
            ->where('barang_keluars.status', '=', 'validate')
            ->get();
            return view('Export.laporanBarangRuanganExport', ['data' => $data]);
    }
}
