<?php

namespace App\Http\Controllers\Kepegawaian;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class PenggajianController extends Controller
{
    //
    public function index(Request $request){

        $request->session()->put('page','penggajian');
        return view('kepegawaian.penggajian');
    }
}
