<?php

namespace App\Http\Controllers\Kepegawaian;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    //

    public function index(Request $request){
        
        if($request->session()->has('token_distrib')){
            return redirect('/');
        }
        return view('kepegawaian.login');
    }


    public function login(Request $request){
        return redirect()->route('dashboard');
    }

}
