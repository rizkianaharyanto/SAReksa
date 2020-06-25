<?php

namespace App\Http\Controllers\Kepegawaian;
use App\Http\Controllers\Controller;
use App\Kepegawaian\Jabatan;
use App\Kepegawaian\Pegawai;
use App\Kepegawaian\Ptkp;

use Illuminate\Http\Request;

class PegawaiController extends Controller
{
    //
    public function index(Request $request){
        $pegawais = Pegawai::all();
        $request->session()->put('page','pegawai');
        $request->session()->put('title','Pegawai');
        return view('kepegawaian.pegawai', compact('pegawais'));
    }

    public function tambah(Request $request){
        $pegawais = Pegawai::all();
        $jabatans = Jabatan::all();
        $ptkps = Ptkp::all();
        $request->session()->put('page','pegawai');
        return view('kepegawaian.pegawai.tambah', compact('pegawais','jabatans','ptkps'));
    }

    public function add(Request $request)
    {

        $request->validate([
            'nama' => 'required',
            'jabatan_id' => 'required',
            'kode_pegawai' => 'required',
            'ktp' => 'required',
            'email' => 'required',
            'handphone' => 'required',
            'masuk' => 'required',
            'catatan' => 'required',
            'alamat' => 'required',
            'kode_pos' => 'required',
            'npwp' => 'required',
            'ptkp' => 'required',
        ]);
        Pegawai::create($request->all());
        $pegawai = Pegawai::latest()->first();
        $jabatan = Jabatan::find($request->jabatan_id);
        $pegawai->jabatans()->attach($jabatan->id,['tanggal'=>$request->masuk]);
        

        return redirect('kepegawaian/pegawai')->with('status','Tambah pegawai berhasil');
    }


}
