<?php

namespace App\Http\Controllers\Kepegawaian;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //
    public function index(Request $request){

        $request->session()->put('page','dashboard');
        return view('kepegawaian.dashboard');
    }
}
