<?php

namespace App\Http\Controllers\Pembelian;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Pembelian\Pemasok;

class PemasoksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pemasoks = Pemasok::all();
        return view('pembelian.manajemendata.supplier', compact('suppliers'));
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
        Pemasok::create($request->all());
        return redirect('/pemasoks');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  Pemasok $pemasok
     * @return \Illuminate\Http\Response
     */
    public function show(Pemasok $pemasok)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  Pemasok $pemasok
     * @return \Illuminate\Http\Response
     */
    public function edit(Pemasok $pemasok)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  Pemasok $pemasok
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pemasok $pemasok)
    {
        Pemasok::where('id', $pemasok->id)
            ->update([
                'nama_pemasok' => $request->nama_pemasok,
                'telp_pemasok' => $request->telp_pemasok,
                'email_pemasok' => $request->email_pemasok,
                'alamat_pemasok' => $request->alamat_pemasok
            ]);

        return redirect('/pemasoks');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  Pemasok $pemasok
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pemasok $pemasok)
    {
        Pemasok::destroy($pemasok->id);
        return redirect('/pemasoks');
    }
}
