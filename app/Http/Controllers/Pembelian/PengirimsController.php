<?php

namespace App\Http\Controllers\Pembelian;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Pembelian\Pengirim;
use App\Pembelian\Pemasok;

class PengirimsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pengirims = Pengirim::all();

        return view('pembelian.manajemendata.pengirim', [
            'pengirims' => $pengirims,
            'pemasoks' => Pemasok::all(),
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
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $peng = Pengirim::max('id') + 1;
        $pengirim = new Pengirim();
        $pengirim->kode_pengirim = 'PENG-' . $peng;
        $pengirim->nama_pengirim = $request->nama_pengirim;
        $pengirim->telp_pengirim = $request->telp_pengirim;
        $pengirim->email_pengirim = $request->email_pengirim;
        $pengirim->pemasok_id = $request->pemasok_id;
        $pengirim->save();

        return redirect('/pembelian/pengirims');
    }

    /**
     * Display the  specified resource.
     *
     * @param int  Pengirim $pengirim
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Pengirim $pengirim)
    {
        $pengirim = Pengirim::find($pengirim);

        return $pengirim;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int  Pengirim $pengirim
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Pengirim $pengirim)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int  Pengirim            $pengirim
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pengirim $pengirim)
    {
        Pengirim::where('id', $pengirim->id)
            ->update([
                'nama_pengirim' => $request->nama_pengirim,
                'telp_pengirim' => $request->telp_pengirim,
                'email_pengirim' => $request->email_pengirim,
                'pemasok_id' => $request->pemasok_id,
            ]);

        return redirect('/pembelian/pengirims');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int  Pengirim $pengirim
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pengirim $pengirim)
    {
        Pengirim::destroy($pengirim->id);

        return redirect('/pembelian/pengirims');
    }
}
