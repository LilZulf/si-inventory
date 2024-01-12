<?php

namespace App\Http\Controllers;

use App\Models\RusakDalam;
use App\Models\Barang;
use App\Models\Pj;
use App\Models\Ruang;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class BarangRusakDalamController extends Controller
{
    public function index()
    {
        $rusakdalam = RusakDalam::select('rusak_dalams.*', 'pj.nama_pj', 'barangs.nama_barang', 'ruangs.ruangan')
            ->leftJoin('pj', 'rusak_dalams.id_pj', '=', 'pj.id')
            ->leftJoin('barangs', 'rusak_dalams.id_barang', '=', 'barangs.id_barang')
            ->leftJoin('ruangs', 'rusak_dalams.id_ruangan', '=', 'ruangs.id')
            ->get();
        return view('barang_rusak_dalam.rusakDalam', ['rusakdalams' => $rusakdalam]);
    }

    public function tambah()
    {
        $pj = Pj::all();
        $barang = Barang::all();
        $ruang = Ruang::all();
        return view('barang_rusak_dalam/rusakDalamTambah', ['pjs'=>$pj, 'barangs'=>$barang, 'ruangs'=>$ruang,]);
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_pj' => 'required',
            'id_barang' => 'required',
            'jumlah_rusak' => 'required|numeric',
            'id_ruangan' => 'required',
            'tanggal_rusak' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect('/rusak/dalam/tambah')->withErrors($validator)->withInput();
        }

        RusakDalam::create([
            'id_pj' => $request->id_pj,
            'id_barang' => $request->id_barang,
            'jumlah_rusak' => $request->jumlah_rusak,
            'id_ruangan' => $request->id_ruangan,
            'tanggal_rusak' => $request->tanggal_rusak,
            'status' => 1,
        ]);
        return redirect('/rusak/dalam')->with('success', "Berhasil Menambahkan Data Rusak Ruangan");
    }

    public function updatePage($id)
    {
        $pj = Pj::all();
        $barang = Barang::all();
        $ruang = Ruang::all();
        $data = RusakDalam::find($id);
        if (!$data) {
            return redirect()->route('/rusak/dalam')->with('error', 'Data Tidak Ditemukan');
        }
        return view('barang_rusak_dalam.rusakDalamEdit', ['datas' => $data, 'pjs' => $pj, 'barangs' => $barang, 'ruangs' => $ruang]);
    }

    public function update(Request $request, $id)
    {
        // Validasi input menggunakan Validator
        $validator = Validator::make($request->all(), [
            'id_pj' => 'required',
            'id_barang' => 'required',
            'jumlah_rusak' => 'required|numeric',
            'id_ruangan' => 'required',
            'tanggal_rusak' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect('/rusak/dalam/edit/' . $id)->withErrors($validator)->withInput();
        }

        try {
            $data = RusakDalam::findOrFail($id);

            // Update atribut sesuai dengan permintaan
            $data->id_pj = $request->id_pj;
            $data->id_barang = $request->id_barang;
            $data->jumlah_rusak = $request->jumlah_rusak;
            $data->id_ruangan = $request->id_ruangan;
            $data->tanggal_rusak = $request->tanggal_rusak;
            $data->status = 1;

            $data->save();

            return redirect('/rusak/dalam')->with('success', 'Data Barang Rusak Ruangan Berhasil Diperbarui');
        } catch (ModelNotFoundException $e) {
            // Tangani pengecualian jika Ruangan dengan ID tertentu tidak ditemukan
            return redirect('/rusak/dalam')->with('error', 'Data Barang Tidak Ditemukan ' . $e);
        }
    }

    public function delete($id)  {
        try {
            $rusakdalam = RusakDalam::findOrFail($id);
            $rusakdalam->delete();

            return redirect('/rusak/dalam')->with('success', 'Data Barang Rusak Ruangan berhasil dihapus');
        } catch (ModelNotFoundException $e) {
            // Tangani pengecualian jika ruangan dengan ID tertentu tidak ditemukan
            return redirect('/rusak/dalam')->with('error', 'Data Barang tidak ditemukan');
        } catch (\Exception $e) {
            // Tangani pengecualian umum (contoh: gagal menghapus)
            return redirect('/rusak/dalam')->with('error', 'Gagal menghapus data Barang');
        }
        
    }

    public function changeStatus(Request $request)
    {
        $rusakdalam = RusakDalam::find($request->id_rusak_dalam);
        $rusakdalam->status = $rusakdalam->status + 1;
        $rusakdalam->save();

        return redirect('/rusak/dalam/')->with('success', 'Berhasil Mengubah Status');
    }

}
