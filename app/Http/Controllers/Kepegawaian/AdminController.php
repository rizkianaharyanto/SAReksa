<?php

namespace App\Http\Controllers\Kepegawaian;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    //
    public function index(Request $request){

        $request->session()->put('page','admin');
        $request->session()->put('title','Admin');
        return view('kepegawaian.admin');
    }

    public function pph(Request $request){

        $request->session()->put('page','admin');
        return view('kepegawaian.pph');
    }

    public function ptkp(Request $request){

        $request->session()->put('page','admin');
        return view('kepegawaian.admin');
    }
}
