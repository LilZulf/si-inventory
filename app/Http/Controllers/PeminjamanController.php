<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori;
use App\Models\Ruang;
use App\Models\BarangKeluar;
use App\Models\Barang;
use App\Models\Peminjaman;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PeminjamanController extends Controller
{
    public function index()
    {
        $barangs = Peminjaman::join('barangs','peminjamans.id_barang','=','barangs.id_barang')
        ->join('kategoris', 'barangs.id_kategori', '=', 'kategoris.id_kategori')
        ->join('ruangs', 'peminjamans.id_ruang', '=', 'ruangs.id')
        ->select('peminjamans.*','barangs.nama_barang','barangs.satuan','barangs.kode_barang','kategoris.nama_kategori','ruangs.ruangan')
        ->get();
        $barangs->transform(function ($item, $key) {
            $item->created_at_formatted = Carbon::parse($item->updated_at)->format('d-m-Y');
            return $item;
        });
        return view ('peminjaman.peminjaman',['barangs'=>$barangs]);
    }

    public function tambah()  {
        $barangs = Barang::all();
        $ruangs = Ruang::all();
        return view('peminjaman.peminjamanTambah',['barangs' => $barangs,'ruangs'=>$ruangs]);
    }

    public function create(Request $request)  {
        // Validasi input menggunakan Validator
        $validator = Validator::make($request->all(), [
            'barang' => 'required',
            'jumlah' => 'required',
            'ruang' => 'required',
            'peminjam'=>'required'
        ]);

        if ($validator->fails()) {
            return redirect('/peminjaman/tambah')->withErrors($validator)->withInput();
        }
        // dd($request);
        Peminjaman::create([
          'id_barang' => $request->barang,
          'jumlah_pinjam' => $request->jumlah,
          'id_ruang' => $request->ruang,
          'status' => 'waiting',
          'peminjam' => $request->peminjam
        ]);
        return redirect('/peminjaman')->with('success', "Berhasil menambahkan Data Peminjaman");
    }

    public function edit($id)  {
        $barangs = Peminjaman::where('id_peminjaman','=', $id)->get()->first();
        $listbarang = Barang::all();
        $listRuang = Ruang::all();
        // dd($listRuang[0]->id);
        return view('peminjaman.peminjamanEdit',['barangs'=> $barangs,'listbarang'=>$listbarang,'listRuang' => $listRuang]);
    }

    public function editproses($id, Request $request)
    {
        // dd($request);
        // dd($request);
        $validator = Validator::make($request->all(), [
            'barang' => 'required',
            'jumlah' => 'required',
            'ruang' => 'required',
            'peminjam' => 'required'
        ]);
    
        if ($validator->fails()) {
            return redirect('/peminjaman/edit/' . $id)->withErrors($validator)->withInput();
        }
    
        $barang = Peminjaman::find($id);
        $barang->update([
            'id_barang' => $request->barang,
            'jumlah_pinjam' => $request->jumlah,
            'id_barang' =>$request->ruang,
            'status' => 'waiting',
            'peminjam' => $request->peminjam
        ]);
    
        return redirect('/peminjaman')->with('success', "Berhasil Mengupdate Barang");
    }
    


    public function delete($id)  {
        $barang =  Peminjaman::find($id);

        $barang->delete();

        return redirect('/peminjaman')->with('success', "Berhasil Menghapus Barang");
    }

    public function pinjamkan($id){
        $peminjaman = Peminjaman::find($id);
        // dd($peminjaman);
        $barang = Barang::find($peminjaman->id_barang);
        $jumlah = $barang->jumlah;
        $jumlah = floatval($jumlah);
        $newJumlah = $peminjaman->jumlah_pinjam;
        $newJumlah = floatval($newJumlah);
        $sum = $jumlah - $newJumlah;
        // dd($sum);
        if($sum < 0){
            return redirect('/peminjaman')->with('Gagal', "Gagal Meminjamkan Barang, Jumlah Peminjaman Melebihi Stock Barang, Silahkan Update Barang");
        } else{
            $barang->update([
                'jumlah' => $sum,
            ]);
            $peminjaman->update([
                'status' => 'borrowed',
            ]);
            return redirect('/peminjaman')->with('success', "Berhasil Meminjamkan Barang");
        }
        
    }
    public function kembalikan($id){
        $peminjaman = Peminjaman::find($id);
        // dd($peminjaman);
        $barang = Barang::find($peminjaman->id_barang);
        $jumlah = $barang->jumlah;
        $jumlah = floatval($jumlah);
        $newJumlah = $peminjaman->jumlah_pinjam;
        $newJumlah = floatval($newJumlah);
        $sum = $jumlah + $newJumlah;
        // dd($sum);
            $barang->update([
                'jumlah' => $sum,
            ]);
            $peminjaman->update([
                'status' => 'returned',
            ]);
            return redirect('/peminjaman')->with('success', "Berhasil Mengembalikan Barang");
        
    }
}
