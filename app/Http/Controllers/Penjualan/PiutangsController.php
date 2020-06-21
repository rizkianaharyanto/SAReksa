<?php

namespace App\Http\Controllers\Penjualan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Penjualan\Piutang;
use App\Penjualan\Pelanggan;
use App\Penjualan\Pembayaran;
use Illuminate\Support\Arr;

class PiutangsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pelanggans = Pelanggan::with('piutang')->get();
        $totals = [];
        foreach ($pelanggans as $pelanggan) {
            $total = $pelanggan->piutang->sum('total_piutang');
            array_push($totals, [
                'total_piutang' => $total
            ]);
        }
        // dd($totals);
        return view('penjualan.piutang.piutang', [
           'pelanggans' => $pelanggans,
           'totals' => $totals,
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $piutangs = Piutang::get()->where('pelanggan_id', $id);
        // dd($piutangs);
        return view('penjualan.piutang.piutangdetails', ['piutangs' => $piutangs]);
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
