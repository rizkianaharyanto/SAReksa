<?php

namespace App\Http\Controllers;

use App\Penjualan\Pelanggan;
use Illuminate\Http\Request;
use Illuminate\View\ViewName;

class PelanggansController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pelanggans = Pelanggan::all();
        // dd($pealnggans);
        return view('penjualan.manajemendata.pelanggan', [
            'pealanggans' => $pelanggans,
            'no' => Pelanggan::max('id'),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Pelanggan::create($request->all());
        return redirect('/penjualan/pelanggan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Pelanggan  $pelanggan
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pelanggan = Pelanggan::find($id);
        $penawarans = $pelanggan->penawarans;
        $pemesanans = $pelanggan->pemesanans;
        $pengirimans = $pelanggan->pengirimans;
        $fakturs = $pelanggan->fakturs;
        return response()
        ->json([
            'pelanggan' => $pelanggan, 
            'penawarans' => $penawarans, 
            'pemesanans' => $pemesanans, 
            'pengirimans'=> $pengirimans,
            'fakturs'=> $fakturs,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Pelanggan  $pelanggan
     * @return \Illuminate\Http\Response
     */
    public function edit(Pelanggan $pelanggan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Pelanggan  $pelanggan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pelanggan $pelanggan)
    {
        Pelanggan::where('id', $pelanggan->id)
            ->update([
                'nama_pelanggan' => $request->nama_pelanggan,
                'telp_pelanggan' => $request->telp_pelanggan,
                'email_pelanggan' => $request->email_pelanggan,
                'alamat_pelanggan' => $request->alamat_pelanggan
            ]);

        return redirect('/penjualan/pelanggans');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Pelanggan  $pelanggan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pelanggan $pelanggan)
    {
        Pelanggan::destroy($pelanggan->id);
        return redirect('/penjualan/pelanggans');
        // return $pelanggan;
    }
}
