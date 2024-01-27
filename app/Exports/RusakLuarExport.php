<?php

namespace App\Exports;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;

class RusakLuarExport implements FromView
{
    use Exportable;
    private $tanggalMulai;
    private $tanggalSelesai;
    private $status;
    public function __construct(String $tanggalMulai, String $tanggalSelesai, String $status)
    {
        $this->tanggalMulai = $tanggalMulai;
        $this->tanggalSelesai = $tanggalSelesai;
        $this->status = $status;
    }

    public function view(): View
    {
        $data= DB::table('rusak_ruangans')
            ->join('barangs', 'rusak_ruangans.id_barang', '=', 'barangs.id_barang')
            ->whereBetween('rusak_ruangans.tanggal_rusak', [$this->tanggalMulai, $this->tanggalSelesai]);
            if ($this->status) {
                $data->where('rusak_ruangans.status', $this->status);
            }
        $data = $data->get();
        return view('Export.laporanRusakLuarExport', ['data' => $data]);
    }
}
