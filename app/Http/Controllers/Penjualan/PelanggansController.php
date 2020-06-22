<?php

namespace App\Http\Controllers\Penjualan;

use App\Penjualan\Pelanggan;
use Illuminate\Http\Request;
use Illuminate\View\ViewName;
use App\Http\Controllers\Controller;


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
            'pelanggans' => $pelanggans,
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
        $sup = Pelanggan::max('id');
        $pelanggan = Pelanggan::create([
            'kode_pelanggan' => 'PEL-'.$sup,
            'nama_pelanggan' => $request->nama_pelanggan,
            'telp_pelanggan' => $request->telp_pelanggan,
            'email_pelanggan' => $request->email_pelanggan,
            'alamat_pelanggan' => $request->alamat_pelanggan,
        ]);

        return redirect('/penjualan/pelanggans');
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
        $piutangs = $pelanggan->piutangs;
        $piutangmasih = null;
        $pemesananpengiriman = null;
        $pemesananfaktur = null;


        $i=0;
        foreach($piutangs as $piutangs){
            if($piutangs->total_piutang != 0){
                $piutangmasih[$i] = $piutangs;
                $i++;
            }
        }
        $k=0;

        $j=0;
        foreach($pemesanans as $pemesanans){
            if($pemesanans->status != 'terkirim'){
                $pemesananpengiriman[$j] = $pemesanans;
                $j++;
            }
            if($pemesanans->status == 'baru'){
                $pemesananfaktur[$k] = $pemesanans;
                $k++;
            }
        }
        // for ($i = 0 ; $i < count($piutang) ; i++) {
        //     if ($piutang[i]->total_piutang != 0){
        //         $piutangmasih[i] = $piutang[i];
        //     }
        // }

        return response()
        ->json([
            'pelanggan' => $pelanggan, 
            'penawarans' => $penawarans, 
            'pemesanans' => $pemesananpengiriman, 
            'pemesananfakturs' => $pemesananfaktur, 
            'pengirimans'=> $pengirimans,
            'fakturs'=> $fakturs,
            'piutangs' => $piutangmasih,
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
