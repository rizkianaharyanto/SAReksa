<?php

namespace App\Http\Controllers\Kepegawaian;

use App\Http\Controllers\Controller;
use App\Kepegawaian\Tunjangan;
use App\Kepegawaian\Akun;
use Illuminate\Http\Request;

class TunjanganController extends Controller
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
        $tunjangans = Tunjangan::all();
        $request->session()->put('page','tunjangan');
        $request->session()->put('title','Penggajian - Tunjangan');
        return view('kepegawaian.penggajian.tunjangan',compact('tunjangans'));
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
            'nama_tunjangan' => 'required',
            'akun_id' => 'required',
        ]);
        Tunjangan::create($request->all());
        

        return redirect('kepegawaian/penggajian/tunjangan')->with('status','Tambah tunjangan berhasil');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Tunjangan $tunjangan, Request $request)
    {
        //
        $akuns = Akun::orderBy('nama_akun', 'asc')->get();;
        $request->session()->put('title','Penggajian - Ubah');
        return view('kepegawaian.penggajian.tunjangan.edit',compact('tunjangan','akuns'));
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
            'nama_tunjangan' => 'required',
            'akun_id' => 'required',
        ]);
        $tunjangan = Tunjangan::find($id);
        $tunjangan->nama_tunjangan = $request->nama_tunjangan;
        $tunjangan->akun_id = $request->akun_id;
        $tunjangan->save();
        return redirect('kepegawaian/penggajian/tunjangan')->with('status','Tunjangan berhasil diubah');

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
    	$tunjangan = Tunjangan::find($id);
    	$tunjangan->delete();
 
        return redirect('kepegawaian/penggajian/tunjangan')->with('status','Tunjangan berhasil dihapus');
    }

    public function tambah(Request $request){
        $akuns = Akun::orderBy('nama_akun', 'asc')->get();;
        $request->session()->put('title','Penggajian - Tunjangan - Tambah');
        return view('kepegawaian.penggajian.tunjangan.tambah', compact('akuns'));
    }
}
