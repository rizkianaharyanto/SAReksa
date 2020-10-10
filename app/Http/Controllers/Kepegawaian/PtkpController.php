<?php

namespace App\Http\Controllers\Kepegawaian;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Kepegawaian\Ptkp;

class PtkpController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        if($request->session()->has('token_distrib')){
            
        }else{
            return redirect('/kepegawaian/login');
        }
        $ptkps = Ptkp::all();
        $request->session()->put('title','Admin - PTKP');
        $request->session()->put('page','ptkp');
        return view('kepegawaian.admin.ptkp',compact('ptkps'));
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
            'status_ptkp' => 'required',
            'keterangan' => 'required',
            'gaji_minimal' => 'required|numeric',
        ]);
        Ptkp::create($request->all());
        $request->session()->put('title','Admin - PTKP');
        return redirect('kepegawaian/admin/ptkp')->with('status','PTKP berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Ptkp $ptkp, Request $request)
    {
        //
        $request->session()->put('title','Admin - PTKP - ubah');
        return view('kepegawaian.admin.ptkp.edit',compact('ptkp'));
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
            'status_ptkp' => 'required',
            'keterangan' => 'required',
            'gaji_minimal' => 'required|numeric',
        ]);
        
        $ptkp = Ptkp::find($id);
        $ptkp->status_ptkp = $request->status_ptkp;
        $ptkp->keterangan = $request->keterangan;
        $ptkp->gaji_minimal = $request->gaji_minimal;
        $ptkp->save();
        return redirect('kepegawaian/admin/ptkp')->with('status','PTKP berhasil diubah');
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
    	$ptkp = Ptkp::find($id);
    	$ptkp->delete();
 
        return redirect('kepegawaian/admin/ptkp')->with('status','PTKP berhasil dihapus');
    }

    public function tambah()
    {
        return view('kepegawaian.admin.ptkp.tambah');
    }
}
