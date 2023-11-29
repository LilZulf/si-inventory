<?php

namespace App\Http\Controllers;

use App\Models\Ruang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\ModelNotFoundException;


class RuangController extends Controller
{
    //

    public function index()
    {
        $data = Ruang::all();
        return view('ruangan.ruangan', ['datas' => $data]);
    }

    public function tambah()
    {
        // $guru = Guru::all();
        return view('ruangan/ruanganTambah');
    }

    public function create(Request $request)
    {
        // Validasi input menggunakan Validator
        $validator = Validator::make($request->all(), [
            'kode_ruangan' => 'required|unique:ruangs',
            'ruangan' => 'required|string|max:255',
            'id_pj' => 'required',
            'keterangan' => 'nullable|string'
        ]);

        if ($validator->fails()) {
            return redirect('/ruangan/tambah')->withErrors($validator)->withInput();
        }

        Ruang::create([
            'kode_ruangan' => $request->kode_ruangan,
            'ruangan' => $request->ruangan,
            'id_pj' => $request->id_pj,
            'keterangan' => $request->keterangan,
        ]);
        return redirect('/ruangan')->with('success', "Berhasil menambahkan Data Ruangan");
    }

    public function updatePage($id)
    {
        $data = Ruang::find($id);
        if (!$data) {
            return redirect()->route('/ruangan')->with('error', 'Data Tidak Ditemukan');
        }
        return view('ruangan/editRuangan', ["data" => $data, "id" => $id]);
    }

    public function update(Request $request, $id)
    {
        // Validasi input menggunakan Validator
        $validator = Validator::make($request->all(), [
            'kode_ruangan' => 'required',
            'ruangan' => 'required|string|max:255',
            'id_pj' => 'required',
            'keterangan' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return redirect('/ruangan/edit/' . $id)->withErrors($validator)->withInput();
        }

        try {
            $data = Ruang::findOrFail($id);

            // Update atribut sesuai dengan permintaan
            $data->kode_ruangan = $request->kode_ruangan;
            $data->ruangan = $request->ruangan;
            $data->id_pj = $request->id_pj;
            $data->keterangan = $request->keterangan;

            $data->save();

            return redirect('/ruangan')->with('success', 'Data Ruangan berhasil diperbarui');
        } catch (ModelNotFoundException $e) {
            // Tangani pengecualian jika Ruangan dengan ID tertentu tidak ditemukan
            return redirect('/ruangan')->with('error', 'Data Ruangan tidak ditemukan ' . $e);
        }
    }

    public function destroy($id)
    {
        try {
            $ruang = Ruang::findOrFail($id);

            // Hapus data ruangan
            $ruang->delete();

            return redirect('/ruangan')->with('success', 'Data Ruangan berhasil dihapus');
        } catch (ModelNotFoundException $e) {
            // Tangani pengecualian jika ruangan dengan ID tertentu tidak ditemukan
            return redirect('/ruangan')->with('error', 'Data Ruangan tidak ditemukan');
        } catch (\Exception $e) {
            // Tangani pengecualian umum (contoh: gagal menghapus)
            return redirect('/ruangan')->with('error', 'Gagal menghapus data Ruangan');
        }
    }





}
