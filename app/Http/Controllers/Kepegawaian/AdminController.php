<?php

namespace App\Http\Controllers\Kepegawaian;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    //
    public function index(Request $request){

        $request->session()->put('page','admin');
        return view('kepegawaian.admin');
    }
}
