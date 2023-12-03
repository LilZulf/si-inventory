<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori;
use App\Models\Ruang;
use App\Models\BarangKeluar;
use App\Models\Barang;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class BarangKeluarController extends Controller
{
    public function index()
    {
        $barangs = BarangKeluar::join('barangs','barang_keluars.id_barang','=','barangs.id_barang')
        ->join('kategoris', 'barangs.id_kategori', '=', 'kategoris.id_kategori')
        ->join('ruangs', 'barang_keluars.id_ruang', '=', 'ruangs.id')
        ->select('barang_keluars.*','barangs.nama_barang','barangs.satuan','barangs.kode_barang','kategoris.nama_kategori','ruangs.ruangan')
        ->get();
        return view ('barang_keluar.barangKeluar',['barangs'=>$barangs]);
    }

    public function tambah()  {
        $barangs = Barang::all();
        $ruangs = Ruang::all();
        return view('barang_keluar.barangKeluarTambah',['barangs' => $barangs,'ruangs' =>$ruangs]);
    }

    public function create(Request $request)  {
        // Validasi input menggunakan Validator
        $validator = Validator::make($request->all(), [
            'barang' => 'required',
            'jumlah' => 'required',
            'ruang' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect('/barang/keluar/tambah')->withErrors($validator)->withInput();
        }

        BarangKeluar::create([
          'id_barang' => $request->barang,
          'jumlah_keluar' => $request->jumlah,
          'id_ruang' => $request->ruang,
          'status' => 'waiting',
        ]);
        return redirect('/barang/keluar')->with('success', "Berhasil menambahkan Barang");
    }

    public function edit($id)  {
        $barangs = BarangKeluar::where('id_barang_keluar','=', $id)->get()->first();
        $listbarang = Barang::all();
        $listRuang = Ruang::all();
        // dd($listRuang[0]->id);
        return view('barang_keluar.barangKeluarEdit',['barangs'=> $barangs,'listbarang'=>$listbarang,'listRuang' => $listRuang]);
    }

    public function editproses($id, Request $request)
    {
        // dd($request);
        $validator = Validator::make($request->all(), [
            'barang' => 'required',
            'jumlah' => 'required',
            'ruang' => 'required'
        ]);
    
        if ($validator->fails()) {
            return redirect('/barang/keluar/edit/' . $id)->withErrors($validator)->withInput();
        }
    
        $barang = BarangKeluar::find($id);
    
        $barang->update([
            'id_barang' => $request->barang,
            'jumlah_keluar' => $request->jumlah,
            'id_barang' =>$request->ruang,
            'status' => 'waiting',
        ]);
    
        return redirect('/barang/keluar')->with('success', "Berhasil Mengupdate Barang");
    }
    


    public function delete($id)  {
        $barang =  BarangKeluar::find($id);

        $barang->delete();

        return redirect('/barang/keluar')->with('success', "Berhasil Menghapus Barang");
    }

    public function validasi($id){
        $barangKeluar = BarangKeluar::find($id);
        // dd($barangKeluar);
        $barang = Barang::find($barangKeluar->id_barang);
        $jumlah = $barang->jumlah;
        $jumlah = floatval($jumlah);
        $newJumlah = $barangKeluar->jumlah_keluar;
        $newJumlah = floatval($newJumlah);
        $sum = $jumlah - $newJumlah;
        if($sum < 0){
            return redirect('/barang/keluar')->with('Gagal', "Gagal Validasi Barang Silahkan Update Barang");
        } else{
            $barang->update([
                'jumlah' => $sum,
            ]);
            $barangKeluar->update([
                'status' => 'validate',
            ]);
            return redirect('/barang/keluar')->with('success', "Berhasil Validasi Barang");
        }
        
    }
}
