<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Validator;

class KategoriController extends Controller
{
    public function index(){
        $kategori = Kategori::all();
        return view('kategori/kategori', ['kategori' => $kategori]);
    } 

    public function Tambah()  {
        return view('kategori/kategoriTambah');
    }

    public function Create(Request $request) {
        $validator = Validator::make($request->all(),[
            'nama' => 'required'
        ]);
        if ($validator->fails()) {
            return redirect('/kategori/tambah')->withErrors($validator)->withInput();
        }
        Kategori::create([
            'nama_kategori' => $request->nama,
        ]);
        return redirect('/kategori');
    }

    public function Rubah($id)  {
        $kategori = Kategori::where('id_kategori','=',$id)->first();

        return view('kategori/kategoriEdit',['kategori' => $kategori]);
    }
    public function Edit($id, Request $request) {
        $kategori = Kategori::where('id_kategori', $id)->first();

        // dd($kategori);
        $validator = Validator::make($request->all(),[
            'nama' => 'required'
        ]);
        if ($validator->fails()) {
            return redirect('/kategori/edit')->withErrors($validator)->withInput();
        }
        $kategori->update([
            'nama_kategori'=>$request->nama
        ]);
        return redirect('/kategori');
    }
    public function Delete($id)  {
        $kategori = Kategori::where('id_kategori',$id)->first();
        $kategori->delete();
        return redirect('/kategori');
    }
}
