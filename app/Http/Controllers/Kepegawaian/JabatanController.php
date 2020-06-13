<?php

namespace App\Http\Controllers\Kepegawaian;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class JabatanController extends Controller
{
    //
    public function index(Request $request){
        $request->session()->put('page','jabatan');
        return view('kepegawaian.jabatan');
    }

    // method untuk insert data ke table pegawai
    public function store(Request $request)
    {
        // insert data ke table pegawai
        DB::table('jabatan')->insert([
            'kode' => $request->kode,
            'jabatan' => $request->jabatan,
        ]);
        // alihkan halaman ke halaman pegawai
        return redirect('kepegawaian/jabatan');
    
    }
}
