<?php

namespace App\Http\Controllers\Kepegawaian;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class PenggunaController extends Controller
{
    //
    public function index(Request $request){

        $request->session()->put('page','pengguna');
        return view('kepegawaian.pengguna');
    }
}
