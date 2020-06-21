<?php

namespace App\Http\Controllers\Penjualan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Penjualan\Penjual;
use App\Penjualan\Pelanggan;


class PenjualsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $penjuals = Penjual::all();
        return view('penjualan.manajemendata.penjual', [
            'penjuals' => $penjuals,
        ]);
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
        $pnj = Penjual::max('id');
        $penjual = new Penjual;
        $penjual->kode_penjual = 'SAL-'.$pnj;
        $penjual->nama_penjual = $request->nama_penjual;
        $penjual->telp_penjual = $request->telp_penjual;
        $penjual->email_penjual = $request->email_penjual;
        $penjual->alamat_penjual = $request->alamat_penjual;
        $penjual->save();
        return redirect('/penjualan/penjuals');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Penjual $penjual)
    {
        $penjual = Penjual::find($penjual);
        return $penjual;
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
    public function update(Request $request,Penjual $penjual)
    {
        Penjual::where('id', $penjual->id)
            ->update([
                'nama_penjual' => $request->nama_penjual,
                'telp_penjual' => $request->telp_penjual,
                'email_penjual' => $request->email_penjual,
                'alamat_penjual' => $request->alamat_penjual,

            ]);

        return redirect('/penjualan/penjuals');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Penjual $penjual)
    {
        Penjual::destroy($penjual->id);
        return redirect('/penjualan/penjuals');
    }
}
