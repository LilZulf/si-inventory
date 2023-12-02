<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori;
use App\Models\Ruang;
use App\Models\Barang;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class BarangController extends Controller
{
    public function index()
    {
        $barangs = Barang::join('kategoris', 'barangs.id_kategori', '=', 'kategoris.id_kategori')
        ->select('barangs.*', 'kategoris.nama_kategori')
        ->get();
        return view ('barang.barang',['barangs'=>$barangs]);
    }

    public function tambah()  {
        $kategoris = Kategori::all();
        return view('barang/barangTambah',['kategoris' => $kategoris]);
    }

    public function create(Request $request)  {
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
            'kode_barang' =>$request->kode,
            'nama_barang'=>$request->nama,
            'id_kategori' => $request->kategori,
            'satuan' => $request->satuan,
            'jumlah' => $request->jumlah
        ]);
        return redirect('/barang')->with('success', "Berhasil menambahkan Barang");
    }

    public function edit($id)  {
        $barangs = Barang::where('id_barang','=', $id)->get()->first();
        $kategoris = Kategori::all();
        return view('barang.barangEdit',['barangs'=> $barangs,'kategoris'=>$kategoris]);
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
            'kode_barang' =>$request->kode,
            'nama_barang'=>$request->nama,
            'id_kategori' => $request->kategori,
            'satuan' => $request->satuan,
            'jumlah' => $request->jumlah
        ]);
    
        return redirect('/barang')->with('success', "Berhasil Mengupdate Barang");
    }
    


    public function delete($id)  {
        $barang =  Barang::find($id);

        $barang->delete();

        return redirect('/barang')->with('success', "Berhasil Menghapus Barang");
    }


    public function indexBarang()
    {
        $ruangs = Ruang::orderBy("kode_ruangan", "asc")->get();
        $barangData = [];
    
        foreach ($ruangs as $ruang) {
            $barangs = Barang::join('kategoris', 'barangs.id_kategori', '=', 'kategoris.id_kategori')
                ->where('barangs.id_ruangan', $ruang->id)
                ->select(
                    'barangs.id_barang',
                    'barangs.nama_barang',
                    'barangs.kode_barang',
                    'barangs.tahun_pengadaan',
                    'kategoris.nama_kategori'
                )
                ->get();
    
            $jumlahBarang = count($barangs);
    
            $barangData[] = [
                'ruang' => $ruang,
                'jumlahBarang' => $jumlahBarang,
                'barang' => $barangs
            ];
        }
        // dd($barangData);
    
        return view('barang_ruang.barangRuang', ['barangData' => $barangData]);
    }
    

        public function infoBarang($id)
    {
        $barangs = Barang::join('ruangs', 'barangs.id_ruangan', '=', 'ruangs.id')
            ->join('kategoris', 'barangs.id_kategori', '=', 'kategoris.id_kategori')
            ->select('barangs.id_barang', 'barangs.nama_barang', 'barangs.kode_barang', 'barangs.tahun_pengadaan', 'ruangs.ruangan', 'kategoris.nama_kategori')
            ->where('ruangs.id',$id)
            ->get();
        return view('barang_ruang.barangInfo', ['barangs' => $barangs]);
    }



}
