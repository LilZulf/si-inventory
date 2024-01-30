<?php

namespace App\Exports;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;

class RusakDalamExport implements FromView
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
    $data = DB::table('rusak_dalams')
            ->join('barangs', 'rusak_dalams.id_barang', '=', 'barangs.id_barang')
            ->whereBetween('rusak_dalams.tanggal_rusak', [$this->tanggalMulai, $this->tanggalSelesai]);
            if ($this->status) {
                $data->where('rusak_dalams.status', $this->status);
            }
        $data = $data->get();
        return view('Export.laporanRusakDalamExport',['data'=>$data]);
}
}
