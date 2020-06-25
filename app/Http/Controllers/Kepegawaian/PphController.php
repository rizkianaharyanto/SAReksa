<?php

namespace App\Http\Controllers\Kepegawaian;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Kepegawaian\Pph;

class PphController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request){
        $pphs = Pph::all();
        $request->session()->put('title','Admin - PPH');
        return view('kepegawaian.admin.pph',compact('pphs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
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
            'batas_minimal' => 'required|numeric',
            'batas_maksimal' => 'required|numeric',
            'persentase' => 'required|numeric',
        ]);
        Pph::create($request->all());
        return redirect('kepegawaian/admin/pph')->with('status','PPH berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Pph $pph, Request $request)
    {
        //
        // return $pph;
        $request->session()->put('title','Admin - PPH - Ubah');
        return view('kepegawaian.admin.pph.edit',compact('pph'));
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
            'batas_minimal' => 'required|numeric',
            'batas_maksimal' => 'required|numeric',
            'persentase' => 'required|numeric',
        ]);
        
        $pph = Pph::find($id);
        $pph->batas_minimal = $request->batas_minimal;
        $pph->batas_maksimal = $request->batas_maksimal;
        $pph->persentase = $request->persentase;
        $pph->save();
        return redirect('kepegawaian/admin/pph')->with('status','PPH berhasil diubah');
        
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
    	$pph = Pph::find($id);
    	$pph->delete();
 
        return redirect('kepegawaian/admin/pph')->with('status','PPH berhasil dihapus');
    }

    public function tambah(Request $request)
    {
        $request->session()->put('title','Admin - PPH - Tambah');
        return view('kepegawaian.admin.pph.tambah');
    }
}
