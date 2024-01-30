<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Ruang;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //
    public function index(){
        $data = Barang::all();
        $ruangan = Ruang::all();
        return view('dashboard', compact(['data', 'ruangan']));
    }
}
