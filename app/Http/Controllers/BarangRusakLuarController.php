<?php

namespace App\Http\Controllers;

use App\Models\RusakRuangan;
use App\Models\Barang;
use App\Models\Pj;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class BarangRusakLuarController extends Controller
{
    public function index()
    {
        $rusakluar = RusakRuangan::select('rusak_ruangans.*', 'pj.nama_pj', 'barangs.nama_barang')
            ->leftJoin('pj', 'rusak_ruangans.id_pj', '=', 'pj.id')
            ->leftJoin('barangs', 'rusak_ruangans.id_barang', '=', 'barangs.id_barang')
            ->get();
        return view('barang_rusak_luar.rusakLuar', ['rusakluars' => $rusakluar]);
    }

    public function tambah()
    {
        $pj = Pj::all();
        $barang = Barang::all();
        return view('barang_rusak_luar.rusakLuarTambah', ['pjs'=>$pj, 'barangs'=>$barang]);
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_pj' => 'required',
            'id_barang' => 'required',
            'jumlah_rusak' => 'required|numeric',
            'tanggal_rusak' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect('/rusak/luar/tambah')->withErrors($validator)->withInput();
        }

        RusakRuangan::create([
            'id_pj' => $request->id_pj,
            'id_barang' => $request->id_barang,
            'jumlah_rusak' => $request->jumlah_rusak,
            'tanggal_rusak' => $request->tanggal_rusak,
            'status' => 1,
        ]);
        return redirect('/rusak/luar')->with('success', "Berhasil Menambahkan Data Rusak Luar");
    }

    public function updatePage($id)
    {
        $pj = Pj::all();
        $barang = Barang::all();
        $data = RusakRuangan::find($id);
        if (!$data) {
            return redirect()->route('/rusak/luar')->with('error', 'Data Tidak Ditemukan');
        }
        return view('barang_rusak_luar.rusakLuarEdit', ['datas' => $data, 'pjs' => $pj, 'barangs' => $barang]);
    }

    public function update(Request $request, $id)
    {
        // Validasi input menggunakan Validator
        $validator = Validator::make($request->all(), [
            'id_pj' => 'required',
            'id_barang' => 'required',
            'jumlah_rusak' => 'required|numeric',
            'tanggal_rusak' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect('/rusak/luar/edit/' . $id)->withErrors($validator)->withInput();
        }

        try {
            $data = RusakRuangan::findOrFail($id);

            // Update atribut sesuai dengan permintaan
            $data->id_pj = $request->id_pj;
            $data->id_barang = $request->id_barang;
            $data->jumlah_rusak = $request->jumlah_rusak;
            $data->tanggal_rusak = $request->tanggal_rusak;
            $data->status = 1;

            $data->save();

            return redirect('/rusak/luar')->with('success', 'Data Barang Rusak Luar Berhasil Diperbarui');
        } catch (ModelNotFoundException $e) {
            // Tangani pengecualian jika Ruangan dengan ID tertentu tidak ditemukan
            return redirect('/rusak/luar')->with('error', 'Data Barang Tidak Ditemukan ' . $e);
        }
    }

    public function delete($id)  {
        try {
            $rusakluar = RusakRuangan::findOrFail($id);
            $rusakluar->delete();

            return redirect('/rusak/luar')->with('success', 'Data Barang Rusak Luar berhasil dihapus');
        } catch (ModelNotFoundException $e) {
            // Tangani pengecualian jika ruangan dengan ID tertentu tidak ditemukan
            return redirect('/rusak/luar')->with('error', 'Data Barang tidak ditemukan');
        } catch (\Exception $e) {
            // Tangani pengecualian umum (contoh: gagal menghapus)
            return redirect('/rusak/luar')->with('error', 'Gagal menghapus data Barang');
        }
    }

    public function changeStatus(Request $request)
    {
        $rusakluar = RusakRuangan::find($request->id_rusak_luar);
        $rusakluar->status = $rusakluar->status + 1;
        $rusakluar->save();

        return redirect('/rusak/luar/')->with('success', 'Berhasil Mengubah Status');
    }
}
