<?php

namespace App\Http\Controllers;

use App\Models\Pj;
use App\Helpers\HashHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class PjController extends Controller
{
    //
    public function index()
    {
        $data = Pj::all();
        return view('users.pj', ['datas' => $data]);
    }

    public function tambah()
    {
        // $guru = Guru::all();
        return view('users/pjTambah');
    }

    public function create(Request $request)
    {
        // Validasi input menggunakan Validator
        $hashedPassword = HashHelper::encryptPassword($request->password);
        $validator = Validator::make($request->all(), [
            'nama_pj' => 'required|string|max:255',
            'nip' => 'required|unique:pj',
            'alamat' => 'required|string',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'email' => 'nullable|email|unique:pj',
            'password' => 'nullable|string|min:8',
        ]);

        if ($validator->fails()) {
            return redirect('/pj/tambah')->withErrors($validator)->withInput();
        }

        Pj::create([
            'nama_pj' => $request->nama_pj,
            'nip' => $request->nip,
            'alamat' => $request->alamat,
            'jenis_kelamin' => $request->jenis_kelamin,
            'email' => $request->email,
            'password' => $hashedPassword,
        ]);
        return redirect('/pj')->with('success', "Berhasil menambahkan Data Ruangan");
    }

    public function updatePage($id)
    {
        $data = Pj::find($id);
        if (!$data) {
            return redirect()->route('/pj')->with('error', 'Data Tidak Ditemukan');
        }
        return view('users/pj-edit', ["data" => $data, "id" => $id]);
    }

    public function update(Request $request, $id)
    {
        // Validasi input menggunakan Validator
        $validator = Validator::make($request->all(), [
            'nama_pj' => 'required|string|max:255',
            'nip' => 'required|unique:pj,nip,' . $id,
            'alamat' => 'required|string',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'email' => 'nullable|email|unique:pj,email,' . $id,
            'password' => 'nullable|string|min:8', // Update password if provided
        ]);

        if ($validator->fails()) {
            return redirect('/pj/edit/' . $id)->withErrors($validator)->withInput();
        }

        // Retrieve the Pj record you want to update
        $pj = Pj::find($id);

        // Check if the record exists
        if (!$pj) {
            return redirect('/pj')->with('error', "Data Ruangan tidak ditemukan");
        }

        // Update the Pj record with the new data
        $pj->nama_pj = $request->nama_pj;
        $pj->nip = $request->nip;
        $pj->alamat = $request->alamat;
        $pj->jenis_kelamin = $request->jenis_kelamin;
        $pj->email = $request->email;

        // Update the password if provided
        if ($request->password) {
            $hashedPassword = HashHelper::encryptPassword($request->password);
            $pj->password = $hashedPassword;
        }

        // Save the updated Pj record
        $pj->save();

        return redirect('/pj')->with('success', "Berhasil mengupdate Data Ruangan");
    }

    public function destroy($id)
    {
        try {
            $pj = Pj::findOrFail($id);

            // Hapus data ruangan
            $pj->delete();

            return redirect('/pj')->with('success', 'Data PJ Ruangan berhasil dihapus');
        } catch (ModelNotFoundException $e) {
            // Tangani pengecualian jika ruangan dengan ID tertentu tidak ditemukan
            return redirect('/pj')->with('error', 'Data PJ Ruangan tidak ditemukan');
        } catch (\Exception $e) {
            // Tangani pengecualian umum (contoh: gagal menghapus)
            return redirect('/pj')->with('error', 'Gagal menghapus data PJ Ruangan');
        }
    }




}
