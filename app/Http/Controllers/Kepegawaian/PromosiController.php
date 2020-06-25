<?php

namespace App\Http\Controllers\Kepegawaian;

use App\Http\Controllers\Controller;
use App\Kepegawaian\Jabatan;
use App\Kepegawaian\Pegawai;
use Illuminate\Http\Request;

class PromosiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $pegawais = Pegawai::all();
        // $pegawais = Pegawai::with(['jabatans' => function ($q) {
        //     $q->orderBy('pivot_tanggal', 'asc');
        // }])->first();

        // $pegawais = Pegawai::first();
        // $jabatans = $pegawais->jabatans()->orderBy('pivot_tanggal', 'asc')->get();

        // dd($jabatans);

        $request->session()->put('page','jabatan');
        $request->session()->put('title','Jabatan - Promosi History');
        return view('kepegawaian.jabatan.promosi', compact('pegawais'));
    }

    public function tambah(Request $request){
        $pegawais = Pegawai::orderBy('kode_pegawai', 'asc')->get();;
        $jabatans = Jabatan::orderBy('nama_jabatan', 'asc')->get();;
        $request->session()->put('page','jabatan');
        $request->session()->put('title','Jabatan - Promosi - Tambah');
        return view('kepegawaian.jabatan.promosi.tambah', compact('pegawais','jabatans'));
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
            'pegawai_id' => 'required',
            'jabatan_id' => 'required',
            'tanggal' => 'required',
        ]);
        $pegawai = Pegawai::find($request->pegawai_id);
        $jabatan = Jabatan::find($request->jabatan_id);
        $pegawai->jabatans()->attach($jabatan->id,['tanggal'=>$request->tanggal]);
        return redirect('kepegawaian/jabatan/promosi')->with('status','Promosi jabatan baru berhasil');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
    }
}
