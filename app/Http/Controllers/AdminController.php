<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index(){
        $admin = Admin::all();
        return view('Admin/Admin',['admin' => $admin]);
    }

    public function tambah()  {
        return view('Admin/tambahAdmin');
    }

    public  function create(Request $request) {
        $validator = Validator::make($request->all(),[
            'nama' => 'required',
            'nip' => 'required | unique:admins,nip',
            'alamat' => 'required',
            'jenis_kelamin' => 'required',
            'email' => 'required|email|unique:admins',
            'password' => 'required',
        ]);
        if($validator->fails()){
            return redirect('/admin/tambah')->withErrors($validator)->withInput();
        }
        Admin::create([
            'nama'=> $request->nama,
            'nip' => $request->nip,
            'alamat' => $request->alamat,
            'jenis_kelamin' => $request->jenis_kelamin,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);
        return redirect('/admin')->with('success', "Berhasil Tamabh Data Admin");
    }

    public function editIndex($id){
        $admin = Admin::find($id);
        return view('Admin/editAdmin', ['admin' => $admin] );
    }

    public function edit(Request $request, $id)  {
         $validator = Validator::make($request->all(),[
            'nama' => 'required',
            'nip' => 'required',
            'alamat' => 'required',
            'jenis_kelamin' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);
        if($validator->fails()){
            return redirect('/admin/edit/'.$id)->withErrors($validator)->withInput();
        }
        $admin = Admin::find($id);

        $admin->update([
            'nama'=> $request->nama,
            'nip' => $request->nip,
            'alamat' => $request->alamat,
            'jenis_kelamin' => $request->jenis_kelamin,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);
        return redirect('/admin')->with('success', "Berhasil mengupdate Data Admin");
    }

    public function delete(Request $request,$id){
        $admin = Admin::findOrFail($id);
        $admin->delete();
        return redirect('/admin')->with('success', "Berhasil Hapus Data Admin");
    }
}
