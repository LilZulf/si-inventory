<?php

namespace App\Exports;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;


class LaporanExport implements FromView {
    use Exportable;
    private $tanggalMulai;
    private $tanggalSelesai;
    public function __construct(String $tanggalMulai, String $tanggalSelesai)
    {
        $this->tanggalMulai = $tanggalMulai;
        $this->tanggalSelesai = $tanggalSelesai;
    }

    public function view() :View {
        $data = DB::table('barang_masuks')
            ->join('barangs', 'barang_masuks.id_barang', '=', 'barangs.id_barang')
            ->select('barang_masuks.*', 'barangs.nama_barang', 'barangs.created_at as barang_created_at', 'barangs.updated_at as barang_updated_at')
            ->whereBetween('barang_masuks.created_at', [$this->tanggalMulai, $this->tanggalSelesai])
            ->get();
            foreach ($data as $item) {
                $item->formatted_updated_at = \Carbon\Carbon::parse($item->updated_at)->format('d-m-Y');
            }
            return view('Export.laporanBarangMasukExport', ['data' => $data]);
    }
    
}
