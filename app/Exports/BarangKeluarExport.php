<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;

class BarangKeluarExport implements FromView
{
    use Exportable;
    private $tanggalMulai;
    private $tanggalSelesai;
    public function __construct(String $tanggalMulai, String $tanggalSelesai)
    {
        $this->tanggalMulai = $tanggalMulai;
        $this->tanggalSelesai = $tanggalSelesai;
    }
    public function view() :View {
        $data = DB::table('barang_keluars')
            ->join('barangs', 'barang_keluars.id_barang', '=', 'barangs.id_barang')
            ->join('ruangs', 'barang_keluars.id_ruang', '=', 'ruangs.id')
            ->select('barang_keluars.*', 'barangs.nama_barang', 'ruangs.ruangan', 'barangs.created_at as barang_created_at', 'barangs.updated_at as barang_updated_at', 'ruangs.created_at as ruang_created_at', 'ruangs.updated_at as ruang_updated_at')
            ->whereBetween('barang_keluars.created_at', [$this->tanggalMulai, $this->tanggalSelesai])
            ->get();
            foreach ($data as $item) {
                $item->formatted_created_at = \Carbon\Carbon::parse($item->created_at)->format('d-m-Y');
            }
            return view('Export.laporanBarangKeluarExport', ['data' => $data]);
    }
}
