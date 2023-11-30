<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori;
use App\Models\Ruang;
use App\Models\Barang;
use Illuminate\Support\Facades\Validator;

class BarangController extends Controller
{
    public function index()
    {
        $barangs = Barang::join('ruangs', 'barangs.id_ruangan', '=', 'ruangs.id')
        ->join('kategoris', 'barangs.id_kategori', '=', 'kategoris.id_kategori')
        ->select('barangs.*', 'ruangs.ruangan', 'kategoris.nama_kategori')
        ->get();
        return view ('barang.barang',['barangs'=>$barangs]);
    }

    public function tambah()  {
        $kategoris = Kategori::all();
        $ruangs = Ruang::all();
        return view('barang/barangTambah',['kategoris' => $kategoris,'ruangs'=>$ruangs]);
    }

    public function create(Request $request)  {
        // Validasi input menggunakan Validator
        $validator = Validator::make($request->all(), [
            'kode' => 'required|unique:barangs,kode_barang',
            'kategori' => 'required',
            'lokasi' => 'required',
            'nama' => 'required',
            'tahun' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect('/barang/tambah')->withErrors($validator)->withInput();
        }

        Barang::create([
            'nama_barang'=>$request->nama,
            'kode_barang' =>$request->kode,
            'tahun_pengadaan' => $request->tahun,
            'id_ruangan' => $request->lokasi,
            'id_kategori' => $request->kategori
        ]);
        return redirect('/barang')->with('success', "Berhasil menambahkan Barang");
    }

    public function edit($id)  {
        $barangs = Barang::where('id_barang','=', $id)->get()->first();
        $kategoris = Kategori::all();
        $ruangs = Ruang::all();
        return view('barang.barangEdit',['barangs'=> $barangs,'kategoris'=>$kategoris,'ruangs'=>$ruangs]);
    }

    public function editproses($id, Request $request)
    {
        $validator = Validator::make($request->all(), [
            // 'kode' => 'required|unique:barangs,kode_barang,' . $id,
            'kategori' => 'required',
            'lokasi' => 'required',
            'nama' => 'required',
            'tahun' => 'required',
        ]);
    
        if ($validator->fails()) {
            return redirect('/barang/edit/' . $id)->withErrors($validator)->withInput();
        }
    
        $barang = Barang::find($id);
    
        $barang->update([
            'nama_barang' => $request->nama,
            'kode_barang' => $request->kode,
            'tahun_pengadaan' => $request->tahun,
            'id_ruangan' => $request->lokasi,
            'id_kategori' => $request->kategori
        ]);
    
        return redirect('/barang')->with('success', "Berhasil Mengupdate Barang");
    }
    


    public function delete($id)  {
        $barang =  Barang::find($id);

        $barang->delete();

        return redirect('/barang')->with('success', "Berhasil Menghapus Barang");
    }
}
