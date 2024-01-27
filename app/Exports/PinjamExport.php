<?php

namespace App\Exports;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;


class PinjamExport implements FromView
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
    public function view() : View {
        $data = DB::table('peminjamans')
            ->join('barangs', 'peminjamans.id_barang', '=', 'barangs.id_barang')
            ->select('peminjamans.*', 'barangs.nama_barang', 'barangs.created_at as barang_created_at', 'barangs.updated_at as barang_updated_at')
            ->whereBetween('peminjamans.created_at', [$this->tanggalMulai, $this->tanggalSelesai]);
            if ($this->status) {
                $data->where('peminjamans.status', $this->status);
            }
        $data = $data->get();
        foreach ($data as $item) {
            $item->formatted_updated_at = \Carbon\Carbon::parse($item->updated_at)->format('d-m-Y');
        }
        return view('Export.laporanPeminjamanExport', ['data' => $data]);    
    }
}
