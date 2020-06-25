<?php

namespace App\Http\Controllers\Kepegawaian;
use App\Http\Controllers\Controller;
use App\Kepegawaian\Jabatan;
use App\Kepegawaian\Pegawai;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class JabatanController extends Controller
{
    //
    public function index(Request $request){
        $jabatans = Jabatan::all();
        $request->session()->put('page','jabatan');
        $request->session()->put('title','Jabatan');
        return view('kepegawaian.jabatan',compact('jabatans'));
    }

    // method untuk insert data ke table pegawai
    public function store(Request $request)
    {
        // insert data ke table pegawai
        // DB::table('jabatan')->insert([
        //     'kode' => $request->kode,
        //     'jabatan' => $request->jabatan,
        // ]);
        // alihkan halaman ke halaman pegawai
        return redirect('kepegawaian/jabatan');
    
    }

    public function add(Request $request)
    {

        $request->validate([
            'nama_jabatan' => 'required'
        ]);
        Jabatan::create($request->all());

        return redirect('kepegawaian/jabatan')->with('status','Tambah jabatan berhasil');
    }

    public function Riwayat(Request $request){
        $jabatans = Jabatan::all();
        $request->session()->put('page','jabatan');
        return view('kepegawaian.jabatan',compact('jabatans'));
    }

}
