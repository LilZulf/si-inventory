<?php

namespace App\Http\Controllers;

use App\Models\RusakDalam;
use App\Models\RusakRuangan;
use App\Models\Barang;
use App\Models\Pj;
use App\Models\Ruang;
use App\Models\BarangMasuk;
use App\Models\BarangKeluar;

use Illuminate\Http\Request;
use App\Exports\LaporanExport;
use Illuminate\Support\Facades\DB;
use Excel;
use PDF;
use Illuminate\Support\Facades\Validator;

class LaporanController extends Controller
{
    public function rusakDalam()
    {
        return view('laporan.laporanRusakDalam');
    }

    public function prosesLaporanRusakDalam(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'tanggalawal' => 'required',
            'tanggalakhir' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect('/laporan/rusakDalam')->withErrors($validator)->withInput();
        }

        $tanggalMulai = $request->input('tanggalawal');
        $tanggalSelesai = $request->input('tanggalakhir');
        $status = $request->input('status');
        $laporanRusakDalam = DB::table('rusak_dalams')
            ->join('barangs', 'rusak_dalams.id_barang', '=', 'barangs.id_barang')
            ->whereBetween('rusak_dalams.tanggal_rusak', [$tanggalMulai, $tanggalSelesai]);
            if ($status) {
                $laporanRusakDalam->where('rusak_dalams.status', $status);
            }
        $laporanRusakDalam = $laporanRusakDalam->get();

        if ($request->input('action') == 'filter') {
            // Proses filter
            return view('laporan.laporanRusakDalam', ['rusakDalam' => $laporanRusakDalam]);
        } elseif ($request->input('action') == 'excel') {
            // Proses export Excel
            $export = new LaporanExport($laporanRusakDalam);

            return Excel::download($export, 'rekap_' . $tanggalMulai . ' - ' . $tanggalSelesai . '.xlsx');
        } else {
            $pdf = PDF::loadView('laporan.pdfRusakDalam', [
                'rusakDalam' => $laporanRusakDalam
            ]);
            return $pdf->download('laporanRusakDalam_' . $tanggalMulai . ' - ' . $tanggalSelesai . '.pdf');
        }
    }

    public function rusakLuar()
    {
        return view('laporan.laporanRusakLuar');
    }

    public function prosesLaporanRusakLuar(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'tanggalawal' => 'required',
            'tanggalakhir' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect('/laporan/rusakLuar')->withErrors($validator)->withInput();
        }

        $tanggalMulai = $request->input('tanggalawal');
        $tanggalSelesai = $request->input('tanggalakhir');
        $status = $request->input('status');
        $laporanRusakLuar = DB::table('rusak_ruangans')
            ->join('barangs', 'rusak_ruangans.id_barang', '=', 'barangs.id_barang')
            ->whereBetween('rusak_ruangans.tanggal_rusak', [$tanggalMulai, $tanggalSelesai]);
            if ($status) {
                $laporanRusakLuar->where('rusak_ruangans.status', $status);
            }
        $laporanRusakLuar = $laporanRusakLuar->get();

        if ($request->input('action') == 'filter') {
            // Proses filter
            return view('laporan.laporanRusakLuar', ['rusakLuar' => $laporanRusakLuar]);
        } elseif ($request->input('action') == 'excel') {
            // Proses export Excel
            $export = new LaporanExport($laporanRusakLuar);

            return Excel::download($export, 'rekap_' . $tanggalMulai . ' - ' . $tanggalSelesai . '.xlsx');
        } else {
            $pdf = PDF::loadView('laporan.pdfRusakLuar', [
                'rusakLuar' => $laporanRusakLuar
            ]);
            return $pdf->download('laporanRusakLuar_' . $tanggalMulai . ' - ' . $tanggalSelesai . '.pdf');
        }
    }

    public function barangMasuk()
    {
        return view('laporan.laporanBarangMasuk');
    }

    public function prosesLaporanBarangMasuk(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'tanggalawal' => 'required',
            'tanggalakhir' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect('/laporan/barangMasuk')->withErrors($validator)->withInput();
        }

        $tanggalMulai = $request->input('tanggalawal');
        $tanggalSelesai = $request->input('tanggalakhir');
        $laporanBarangMasuk = DB::table('barang_masuks')
            ->join('barangs', 'barang_masuks.id_barang', '=', 'barangs.id_barang')
            ->select('barang_masuks.*', 'barangs.nama_barang', 'barangs.created_at as barang_created_at', 'barangs.updated_at as barang_updated_at')
            ->whereBetween('barang_masuks.created_at', [$tanggalMulai, $tanggalSelesai])
            ->get();

         // Format ulang tanggal pada $laporanBarangMasuk untuk ditampilkan
        foreach ($laporanBarangMasuk as $item) {
            $item->formatted_updated_at = \Carbon\Carbon::parse($item->updated_at)->format('d-m-Y');
        }

        if ($request->input('action') == 'filter') {
            // Proses filter
            return view('laporan.laporanBarangMasuk', ['barangMasuk' => $laporanBarangMasuk]);
        } elseif ($request->input('action') == 'excel') {
            // Proses export Excel
            $export = new LaporanExport($laporanBarangMasuk);

            return Excel::download($export, 'rekap_' . $tanggalMulai . ' - ' . $tanggalSelesai . '.xlsx');
        } else {
            $pdf = PDF::loadView('laporan.pdfBarangMasuk', [
                'barangMasuk' => $laporanBarangMasuk
            ]);
            return $pdf->download('laporanBarangMasuk_' . $tanggalMulai . ' - ' . $tanggalSelesai . '.pdf');
        }
    }

    public function barangKeluar()
    {
        return view('laporan.laporanBarangKeluar');
    }

    public function prosesLaporanBarangKeluar(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'tanggalawal' => 'required',
            'tanggalakhir' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect('/laporan/barangKeluar')->withErrors($validator)->withInput();
        }

        $tanggalMulai = $request->input('tanggalawal');
        $tanggalSelesai = $request->input('tanggalakhir');
        $laporanBarangKeluar = DB::table('barang_keluars')
            ->join('barangs', 'barang_keluars.id_barang', '=', 'barangs.id_barang')
            ->join('ruangs', 'barang_keluars.id_ruang', '=', 'ruangs.id')
            ->select('barang_keluars.*', 'barangs.nama_barang', 'ruangs.ruangan', 'barangs.created_at as barang_created_at', 'barangs.updated_at as barang_updated_at', 'ruangs.created_at as ruang_created_at', 'ruangs.updated_at as ruang_updated_at')
            ->whereBetween('barang_keluars.created_at', [$tanggalMulai, $tanggalSelesai])
            ->get();

        // Format ulang tanggal pada $laporanBarangKeluar untuk ditampilkan
        foreach ($laporanBarangKeluar as $item) {
            $item->formatted_created_at = \Carbon\Carbon::parse($item->created_at)->format('d-m-Y');
        }

        if ($request->input('action') == 'filter') {
            // Proses filter
            return view('laporan.laporanBarangKeluar', ['barangKeluar' => $laporanBarangKeluar]);
        } elseif ($request->input('action') == 'excel') {
            // Proses export Excel
            $export = new LaporanExport($laporanBarangKeluar);

            return Excel::download($export, 'rekap_' . $tanggalMulai . ' - ' . $tanggalSelesai . '.xlsx');
        } else {
            $pdf = PDF::loadView('laporan.pdfBarangKeluar', [
                'barangKeluar' => $laporanBarangKeluar
            ]);
            return $pdf->download('laporanBarangKeluar_' . $tanggalMulai . ' - ' . $tanggalSelesai . '.pdf');
        }
    }

    public function peminjaman()
    {
        return view('laporan.laporanPeminjaman');
    }

    public function prosesLaporanPeminjaman(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'tanggalawal' => 'required',
            'tanggalakhir' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect('/laporan/peminjaman')->withErrors($validator)->withInput();
        }

        $tanggalMulai = $request->input('tanggalawal');
        $tanggalSelesai = $request->input('tanggalakhir');
        $status = $request->input('status');
        $laporanPeminjaman = DB::table('peminjamans')
            ->join('barangs', 'peminjamans.id_barang', '=', 'barangs.id_barang')
            ->select('peminjamans.*', 'barangs.nama_barang', 'barangs.created_at as barang_created_at', 'barangs.updated_at as barang_updated_at')
            ->whereBetween('peminjamans.created_at', [$tanggalMulai, $tanggalSelesai]);
            if ($status) {
                $laporanPeminjaman->where('peminjamans.status', $status);
            }
        $laporanPeminjaman = $laporanPeminjaman->get();

        // Format ulang tanggal pada $laporanPeminjaman untuk ditampilkan
        foreach ($laporanPeminjaman as $item) {
            $item->formatted_updated_at = \Carbon\Carbon::parse($item->updated_at)->format('d-m-Y');
        }

        if ($request->input('action') == 'filter') {
            // Proses filter
            return view('laporan.laporanPeminjaman', ['peminjaman' => $laporanPeminjaman]);
        } elseif ($request->input('action') == 'excel') {
            // Proses export Excel
            $export = new LaporanExport($laporanPeminjaman);

            return Excel::download($export, 'rekap_' . $tanggalMulai . ' - ' . $tanggalSelesai . '.xlsx');
        } else {
            $pdf = PDF::loadView('laporan.pdfPeminjaman', [
                'peminjaman' => $laporanPeminjaman
            ]);
            return $pdf->download('laporanPeminjaman_' . $tanggalMulai . ' - ' . $tanggalSelesai . '.pdf');
        }
    }

    public function barangRuangan()
    {
        $ruangan = Ruang::all();
        return view('laporan.laporanBarangRuangan', ['ruangans' => $ruangan]);
    }

    public function prosesLaporanBarangRuangan(Request $request)
    {
        $ruangan = Ruang::all();

        $validator = Validator::make($request->all(), [
            'id_ruangan' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect('/laporan/barangRuangan')->withErrors($validator)->withInput();
        }

        $pilihRuangan = $request->input('id_ruangan');
        $laporanBarangRuangan = DB::table('barang_keluars')
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
            ->where('barang_keluars.id_ruang', '=', $pilihRuangan)
            ->where('barang_keluars.status', '=', 'validate')
            ->get();

        if ($request->input('action') == 'filter') {
            // Proses filter
            return view('laporan.laporanBarangRuangan', ['barangRuangan' => $laporanBarangRuangan, 'ruangans' => $ruangan]);
        } elseif ($request->input('action') == 'excel') {
            // Proses export Excel
            $export = new LaporanExport($laporanBarangRuangan);

            return Excel::download($export, 'rekap_' .  '.xlsx');
        } else {
            $pdf = PDF::loadView('laporan.pdfBarangRuangan', [
                'barangRuangan' => $laporanBarangRuangan
            ]);
            
            // Mendapatkan nama ruangan terpilih
            $ruanganTerpilih = Ruang::find($pilihRuangan)->ruangan;

            // Menggabungkan nama file PDF dengan nama ruangan
            $namaFilePDF = 'laporanBarangRuangan_' . $ruanganTerpilih . '.pdf';

            return $pdf->download($namaFilePDF);
        }
    }
}
