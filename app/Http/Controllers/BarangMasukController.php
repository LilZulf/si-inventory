<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori;
use App\Models\Ruang;
use App\Models\BarangMasuk;
use App\Models\Barang;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class BarangMasukController extends Controller
{
    public function index()
    {
        $barangs = BarangMasuk::join('barangs','barang_masuks.id_barang','=','barangs.id_barang')
        ->join('kategoris', 'barangs.id_kategori', '=', 'kategoris.id_kategori')
        ->select('barang_masuks.*','barangs.nama_barang','barangs.satuan','barangs.kode_barang','kategoris.nama_kategori')
        ->get();
        return view ('barang_masuk.barangMasuk',['barangs'=>$barangs]);
    }

    public function tambah()  {
        $barangs = Barang::all();
        // dd($barangs);
        return view('barang_masuk.barangMasukTambah',['barangs' => $barangs]);
    }

    public function create(Request $request)  {
        // Validasi input menggunakan Validator
        $validator = Validator::make($request->all(), [
            'barang' => 'required',
            'jumlah' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect('/barang/masuk/tambah')->withErrors($validator)->withInput();
        }

        BarangMasuk::create([
          'id_barang' => $request->barang,
          'jumlah_masuk' => $request->jumlah,
          'status' => 'waiting',
        ]);
        return redirect('/barang/masuk')->with('success', "Berhasil menambahkan Barang");
    }

    public function edit($id)  {
        $barangs = BarangMasuk::where('id_barang_masuk','=', $id)->get()->first();
        $listbarang = Barang::all();
        // dd($barangs);
        return view('barang_masuk.barangMasukEdit',['barangs'=> $barangs,'listbarang'=>$listbarang]);
    }

    public function editproses($id, Request $request)
    {
        // dd($request);
        $validator = Validator::make($request->all(), [
            'barang' => 'required',
            'jumlah' => 'required',
        ]);
    
        if ($validator->fails()) {
            return redirect('/barang/masuk/edit/' . $id)->withErrors($validator)->withInput();
        }
    
        $barang = BarangMasuk::find($id);
    
        $barang->update([
            'id_barang' => $request->barang,
            'jumlah_masuk' => $request->jumlah,
            'status' => 'waiting',
        ]);
    
        return redirect('/barang/masuk')->with('success', "Berhasil Mengupdate Barang");
    }
    


    public function delete($id)  {
        $barang =  BarangMasuk::find($id);

        $barang->delete();

        return redirect('/barang/masuk')->with('success', "Berhasil Menghapus Barang");
    }

    public function validasi($id){
        $barangMasuk = BarangMasuk::find($id);
        // dd($barangMasuk);
        $barang = Barang::find($barangMasuk->id_barang);
        $jumlah = $barang->jumlah;
        $jumlah = floatval($jumlah);
        $newJumlah = $barangMasuk->jumlah_masuk;
        $newJumlah = floatval($newJumlah);
        $sum = $jumlah + $newJumlah;
        // dd($sum);
        $barang->update([
            'jumlah' => $sum,
        ]);
        $barangMasuk->update([
            'status' => 'validate',
        ]);
        return redirect('/barang/masuk')->with('success', "Berhasil Validasi Barang");
    }
}
