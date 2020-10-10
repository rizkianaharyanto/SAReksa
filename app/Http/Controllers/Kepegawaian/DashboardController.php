<?php

namespace App\Http\Controllers\Kepegawaian;
use App\Http\Controllers\Controller;
use App\Kepegawaian\Pegawai;
use App\Kepegawaian\Penggajian;
use App\Kepegawaian\Jabatan;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //
    public function index(Request $request){

        if($request->session()->has('token_distrib')){
            
        }else{
            return redirect('/kepegawaian/login');
        }

        $total = 0;
        $month = date('m');
        $year = date('Y');
        

        $jabatans = Jabatan::all();
        $pegawais = Pegawai::all();
        $penggajians = Penggajian::where('status',1)->whereMonth('tanggal', '=', $month)->whereYear('tanggal', '=', $year)->get();


        foreach($penggajians as $gaji){
            $total = $gaji->jumlah + $total;
        }
        if( $total >= 0 && $total < 999){
            $satuan = "";
        }else if( $total >= 1000 && $total <= 999999){
            $total = $total / 1000;
            $satuan = "ribu";
        }else if( $total >= 1000000 && $total <= 999999999){
            $total = $total / 1000000;
            $satuan = "juta";
        }else{
            $total = $total / 1000000000;
            $satuan = "milyar";
        }

        $request->session()->put('page','dashboard');
        $request->session()->put('title','Dashboard');
        return view('kepegawaian.dashboard', compact('pegawais','total','satuan','jabatans'));
    }
}
