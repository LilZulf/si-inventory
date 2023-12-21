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
            'email' => 'required|email|unique:pj',
            'password' => 'required|string|min:8',
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




}
