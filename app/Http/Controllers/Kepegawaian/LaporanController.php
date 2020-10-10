<?php

namespace App\Http\Controllers\Kepegawaian;
use App\Http\Controllers\Controller;
use App\Kepegawaian\Penggajian;
use App\Kepegawaian\Pegawai;
use Illuminate\Support\Facades\Crypt;
use PDF;

use Illuminate\Http\Request;

class LaporanController extends Controller
{
    //
    public function index(Request $request){
        if($request->session()->has('token_distrib')){
            
        }else{
            return redirect('/kepegawaian/login');
        }
        $year=2020;
        $month=07;
        $penggajians = Penggajian::whereYear('tanggal', '=', $year)->whereMonth('tanggal', '=', $month)->get();
        $pegawais = Pegawai::all();

        $request->session()->put('page','laporan');
        $request->session()->put('title','Laporan');
        return view('kepegawaian.laporan',compact('penggajians','pegawais'));
    }

    public function bulanan(Request $request){

        $request->validate([
            'bulan' => 'required',
            'tahun' => 'required|digits:4',
        ]);

        $year = $request->tahun;
        $month = $request->bulan;
        
        if($month == '01'){
            $bulan = 'JANUARI';
        }elseif($month == '02'){
            $bulan = 'FEBRUARI';
        }elseif($month == '03'){
            $bulan = 'MARET';
        }elseif($month == '04'){
            $bulan = 'APRIL';
        }elseif($month == '05'){
            $bulan = 'MEI';
        }elseif($month == '06'){
            $bulan = 'JUNI';
        }elseif($month == '07'){
            $bulan = 'JULI';
        }elseif($month == '08'){
            $bulan = 'AGUSTUS';
        }elseif($month == '09'){
            $bulan = 'SEPTEMBER';
        }elseif($month == '10'){
            $bulan = 'OKTOBER';
        }elseif($month == '11'){
            $bulan = 'NOVEMBER';
        }elseif($month == '12'){
            $bulan = 'DESEMBER';
        }
        

        $status = 1;
        $title= 'PERIODE BULAN '.$bulan;

        $request->session()->put('title','Laporan - Bulanan');
        $penggajians = Penggajian::where('status',$status)->whereYear('tanggal', '=', $year)->whereMonth('tanggal', '=', $month)->get();

        $total = 0;

        foreach($penggajians as $gaji){
            $total = $gaji->jumlah + $total;
        }

        return view('kepegawaian.laporan.bulanan',compact('penggajians','bulan','year','title','total'));

    }

    public function pegawai(Request $request){

        $request->validate([
            'pegawai' => 'required',
        ]);
        $status = 1;
        $request->session()->put('title','Laporan - Pegawai');
        $penggajians = Penggajian::where('status',$status)->where('pegawai_id',$request->pegawai)->get();
        // dd($penggajians);
        return view('kepegawaian.laporan.tahunan',compact('penggajians'));

    }

    public function satupegawai(Request $request, $id){

        $status = 1;
        $request->session()->put('title','Laporan - Pegawai');
        $penggajians = Penggajian::where('status',$status)->where('pegawai_id',$id)->get();
        // dd($penggajians);
        return view('kepegawaian.laporan.tahunan',compact('penggajians'));

    }


    public function bulanini(Request $request){

        $month = date('m');
        $year = date('Y');
        
        if($month == '01'){
            $bulan = 'JANUARI';
        }elseif($month == '02'){
            $bulan = 'FEBRUARI';
        }elseif($month == '03'){
            $bulan = 'MARET';
        }elseif($month == '04'){
            $bulan = 'APRIL';
        }elseif($month == '05'){
            $bulan = 'MEI';
        }elseif($month == '06'){
            $bulan = 'JUNI';
        }elseif($month == '07'){
            $bulan = 'JULI';
        }elseif($month == '08'){
            $bulan = 'AGUSTUS';
        }elseif($month == '09'){
            $bulan = 'SEPTEMBER';
        }elseif($month == '10'){
            $bulan = 'OKTOBER';
        }elseif($month == '11'){
            $bulan = 'NOVEMBER';
        }elseif($month == '12'){
            $bulan = 'DESEMBER';
        }
        

        $status = 1;
        $title= 'PERIODE BULAN '.$bulan;

        $request->session()->put('title','Laporan - Bulanan');
        $penggajians = Penggajian::where('status',$status)->whereYear('tanggal', '=', $year)->whereMonth('tanggal', '=', $month)->get();

        $total = 0;

        foreach($penggajians as $gaji){
            $total = $gaji->jumlah + $total;
        }

        return view('kepegawaian.laporan.bulanan',compact('penggajians','bulan','year','title','total'));

    }

    public function slip($id, Request $request)
    {
        //
        $id = Crypt::decryptString($id);
        $penggajian = Penggajian::find($id);
        $tanggal = date('d F Y');

        $request->session()->put('title','Slip');
        $pdf = PDF::loadView('kepegawaian.laporan.slip', compact('penggajian','tanggal'));
        $pdf->setPaper('A4', 'portrait');
        return $pdf->stream('slipgaji.pdf');
    }

}
