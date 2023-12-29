<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori;
use App\Models\Ruang;
use App\Models\Barang;
use App\Models\BarangKeluar;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class BarangController extends Controller
{
    public function index()
    {
        $barangs = Barang::join('kategoris', 'barangs.id_kategori', '=', 'kategoris.id_kategori')
            ->select('barangs.*', 'kategoris.nama_kategori')
            ->get();
        return view('barang.barang', ['barangs' => $barangs]);
    }

    public function tambah()
    {
        $kategoris = Kategori::all();
        return view('barang/barangTambah', ['kategoris' => $kategoris]);
    }

    public function create(Request $request)
    {
        // Validasi input menggunakan Validator
        $validator = Validator::make($request->all(), [
            'kode' => 'required|unique:barangs,kode_barang',
            'kategori' => 'required',
            'satuan' => 'required',
            'nama' => 'required',
            'jumlah' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect('/barang/tambah')->withErrors($validator)->withInput();
        }

        Barang::create([
            'kode_barang' => $request->kode,
            'nama_barang' => $request->nama,
            'id_kategori' => $request->kategori,
            'satuan' => $request->satuan,
            'jumlah' => $request->jumlah
        ]);
        return redirect('/barang')->with('success', "Berhasil menambahkan Barang");
    }

    public function edit($id)
    {
        $barangs = Barang::where('id_barang', '=', $id)->get()->first();
        $kategoris = Kategori::all();
        return view('barang.barangEdit', ['barangs' => $barangs, 'kategoris' => $kategoris]);
    }

    public function editproses($id, Request $request)
    {
        $validator = Validator::make($request->all(), [
            // 'kode' => 'required|unique:barangs,kode_barang',
            'kategori' => 'required',
            'satuan' => 'required',
            'nama' => 'required',
            'jumlah' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect('/barang/edit/' . $id)->withErrors($validator)->withInput();
        }

        $barang = Barang::find($id);

        $barang->update([
            'kode_barang' => $request->kode,
            'nama_barang' => $request->nama,
            'id_kategori' => $request->kategori,
            'satuan' => $request->satuan,
            'jumlah' => $request->jumlah
        ]);

        return redirect('/barang')->with('success', "Berhasil Mengupdate Barang");
    }



    public function delete($id)
    {
        $barang = Barang::find($id);

        $barang->delete();

        return redirect('/barang')->with('success', "Berhasil Menghapus Barang");
    }


    public function indexBarang()
    {
        $ruangs = Ruang::orderBy("kode_ruangan", "asc")->get();
        $barangData = [];

        foreach ($ruangs as $ruang) {
            // Menggunakan leftJoin untuk mendapatkan data ruang yang memiliki barang keluar
            $ruangWithKeluar = Ruang::leftJoin('barang_keluars', function ($join) use ($ruang) {
                $join->on('ruangs.id', '=', 'barang_keluars.id_ruang')
                    ->where('barang_keluars.status', '=', 'validate');
            })
                ->select('ruangs.id', 'ruangs.ruangan', DB::raw('SUM(barang_keluars.jumlah_keluar) as total_jumlah_keluar'))
                ->where('ruangs.id', $ruang->id)
                ->groupBy('ruangs.id', 'ruangs.ruangan')
                ->first();

            $barangData[] = [
                'ruangan' => $ruangWithKeluar->ruangan,
                'jumlah_keluar' => $ruangWithKeluar->total_jumlah_keluar ?? 0,
            ];
        }

        return view('barang_ruang.barangRuang', ['barangData' => $barangData]);
    }

    public function tampilQr($id)
    {
        $barang = BarangKeluar::join('barangs', 'barang_keluars.id_barang', '=', 'barangs.id_barang')
            ->join('kategoris', 'barangs.id_kategori', '=', 'kategoris.id_kategori')
            ->join('ruangs', 'barang_keluars.id_ruang', '=', 'ruangs.id')
            ->join('pj', 'ruangs.id_pj', '=', 'pj.id')
            ->where('barang_keluars.id_barang_keluar', '=', $id)
            ->select(
                'barangs.nama_barang',
                'barangs.kode_barang',
                'barangs.satuan',
                'kategoris.nama_kategori',
                'ruangs.kode_ruangan',
                'ruangs.ruangan',
                'pj.nama_pj',
                'barang_keluars.*'
            )
            ->first();
        $url = url()->full();
        $simple = QrCode::size(250)->generate($url);
        return view('barang_ruang.qrbarang', ['barangData' => $barang, 'simple' => $simple]);
    }
    public function infoBarang($id)
    {
        $barangs = BarangKeluar::join('barangs', 'barang_keluars.id_barang', '=', 'barangs.id_barang')
            ->join('kategoris', 'barangs.id_kategori', '=', 'kategoris.id_kategori')
            ->where('barang_keluars.id_ruang', '=', $id)
            ->where('barang_keluars.status', '=', 'validate')
            ->select(
                'barangs.id_barang',
                'barangs.nama_barang',
                'barangs.kode_barang',
                'barangs.satuan',
                'kategoris.nama_kategori',
                'barang_keluars.*'
            )
            ->get();

        $barangs->transform(function ($item, $key) {
            $item->created_at_formatted = Carbon::parse($item->created_at)->format('d-m-Y');
            return $item;
        });

        return view('barang_ruang.barangInfo', ['barangs' => $barangs]);
    }

    public function kembalikan($id)
    {
        $barangKeluar = BarangKeluar::find($id);

        if (!$barangKeluar) {
            return redirect('/barang/ruang/info/' . $barangKeluar->id_ruang)->with('Gagal', "Barang Keluar tidak ditemukan.");
        }

        $barang = Barang::find($barangKeluar->id_barang);

        if (!$barang) {
            return redirect('/barang/ruang/info/' . $barangKeluar->id_ruang)->with('Gagal', "Barang tidak ditemukan.");
        }

        $jumlahKeluar = $barangKeluar->jumlah_keluar;
        $jumlahSaatIni = $barang->jumlah;


        // Kurangkan jumlah yang keluar dari jumlah saat ini
        $jumlahBaru = $jumlahSaatIni + $jumlahKeluar;

        // Update jumlah barang
        $barang->update([
            'jumlah' => $jumlahBaru,
        ]);

        // Update status barang keluar menjadi 'returned'
        $barangKeluar->update([
            'status' => 'returned',
        ]);

        return redirect('/barang/ruang/info/' . $barangKeluar->id_ruang)->with('success', "Berhasil mengembalikan Barang");
    }



}
