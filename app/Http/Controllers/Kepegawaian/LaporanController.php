<?php

namespace App\Http\Controllers\Kepegawaian;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class LaporanController extends Controller
{
    //
    public function index(Request $request){

        $request->session()->put('page','laporan');
        return view('kepegawaian.laporan');
    }
}