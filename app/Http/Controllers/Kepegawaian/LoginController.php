<?php

namespace App\Http\Controllers\Kepegawaian;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;
use App\Kepegawaian\User;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    //

    public function index(Request $request)
    {
        if ($request->session()->has('token_distrib')) {
            return redirect('/');
        }
        return view('kepegawaian.login');
    }


    public function logincheck(Request $request){
        $username = $request->username;
        $logpassword = $request->password;

        $user = User::where('userable_id',$username)->get();
        
        $check = 'isi';
        if($user->isEmpty()){
            return redirect('kepegawaian/login')->with('status','username atau password salah');
        }


        foreach($user as $cekuser){
            $userpasswordencrypt = $cekuser->password;
            $userable = $cekuser->userable_type;
            $userable_id = $cekuser->userable_id;
            $name = $cekuser->name;
        }

        $userpassword = Crypt::decryptString($userpasswordencrypt);

        if($userpassword == $logpassword){
            $request->session()->put('token_distrib',$userable);
            $request->session()->put('userid',$userable_id);
            $request->session()->put('nama',$name);
            return redirect('kepegawaian');
        }else{
            return redirect('kepegawaian/login')->with('status','username atau password salah');
        }


        dd($check);


    }

    public function logout(Request $request)
    {
        $request->session()->forget('token_distrib');
        return redirect('kepegawaian/login');
    }
}
