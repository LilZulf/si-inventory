<?php

namespace App\Http\Controllers;

use App\Models\Ruang;
use Illuminate\Http\Request;

class RuangController extends Controller
{
    //

    public function index()
    {
        $data = Ruang::all();
        return view('ruangan.ruangan', ['datas' => $data]);
    }
}
