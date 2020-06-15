<?php

namespace App\Http\Controllers\Kepegawaian;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class PegawaiController extends Controller
{
    //
    public function index(Request $request){

        $request->session()->put('page','pegawai');
        return view('kepegawaian.pegawai');
    }
}
