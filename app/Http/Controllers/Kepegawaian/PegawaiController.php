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
        if($request->session()->has('token_distrib')){
            
        }else{
            return redirect('/kepegawaian/login');
        }
        $pegawais = Pegawai::all();
        $ptkps = Ptkp::all();
        $request->session()->put('page','pegawai');
        $request->session()->put('title','Pegawai');
        return view('kepegawaian.pegawai', compact('pegawais','ptkps'));
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
            'nama' => 'required|min:3',
            'jabatan_id' => 'required',
            'kode_pegawai' => 'required',
            'ktp' => 'required|digits:16',
            'email' => 'required|email',
            'handphone' => 'required|min:11|max:13',
            'masuk' => 'required',
            'catatan' => 'required',
            'alamat' => 'required|min:5|max:225',
            'kode_pos' => 'required|digits:5',
            'npwp' => 'required',
            'ptkp' => 'required',
        ]);
        Pegawai::create($request->all());
        $pegawai = Pegawai::latest()->first();
        $jabatan = Jabatan::find($request->jabatan_id);
        $keterangan = 'Awal Masuk';
        $pegawai->jabatans()->attach($jabatan->id,['tanggal'=>$request->masuk, 'keterangan' => $keterangan]);
        

        return redirect('kepegawaian/pegawai')->with('status','Tambah pegawai berhasil');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Pegawai $pegawai, Request $request)
    {
        //
        $jabatans = Jabatan::all();
        $ptkps = Ptkp::all();
        $request->session()->put('title','Pegawai - Ubah');
        return view('kepegawaian.pegawai.edit',compact('pegawai','jabatans','ptkps'));
    }


    public function destroy($id)
    {
        //
    	$pegawai = Pegawai::find($id);
    	$pegawai->delete();
 
        return redirect('kepegawaian/pegawai')->with('status','Pegawai berhasil dihapus');
    }

    public function update(Request $request, $id)
    {

        Pegawai::where('id',$id)
        ->update([
            'nama' => $request->nama,
            'ktp' => $request->ktp,
            'email' => $request->email,
            'handphone' => $request->handphone,
            'masuk' => $request->masuk,
            'catatan' => $request->catatan,
            'alamat' => $request->alamat,
            'kode_pos' => $request->kode_pos,
            'npwp' => $request->npwp,
            'ptkp' => $request->ptkp,
        ]);
        return redirect('kepegawaian/pegawai')->with('status','Pegawai berhasil diubah');
    }
}
