<?php

namespace App\Http\Controllers\Kepegawaian;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Kepegawaian\Akun;

class AkunController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $akuns = Akun::all();
        $request->session()->put('title','Admin - Akun');
        return view('kepegawaian.admin.akun',compact('akuns'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'nama_akun' => 'required',
            'keterangan' => 'required',
        ]);
        Akun::create($request->all());
        return redirect('kepegawaian/admin/akun')->with('status','Akun berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Akun $akun, Request $request)
    {
        //

        $request->session()->put('title','Admin - Akun - Ubah');
        return view('kepegawaian.admin.akun.edit',compact('akun'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $request->validate([
            'nama_akun' => 'required',
            'keterangan' => 'required',
        ]);
        $akun = Akun::find($id);
        $akun->nama_akun = $request->nama_akun;
        $akun->keterangan = $request->keterangan;
        $akun->save();
        return redirect('kepegawaian/admin/akun')->with('status','Akun berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    	$akun = Akun::find($id);
    	$akun->delete();
 
        return redirect('kepegawaian/admin/akun')->with('status','Akun berhasil dihapus');
    }

    public function tambah(Request $request)
    {
        $request->session()->put('title','Admin - Akun - Tambah');
        return view('kepegawaian.admin.akun.tambah');
    }
}
