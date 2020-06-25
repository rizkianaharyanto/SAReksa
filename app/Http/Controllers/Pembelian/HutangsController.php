<?php

namespace App\Http\Controllers\Pembelian;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Pembelian\Hutang;
use App\Pembelian\Pemasok;
use App\Pembelian\Pembayaran;
use Illuminate\Support\Arr;

class HutangsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pemasoks = Pemasok::with('hutangs')->get();
        $totals = [];
        $lunass = [];
        $sisas = [];
        foreach ($pemasoks as $pemasok) {
            $total = $pemasok->hutangs->sum('total_hutang');
            array_push($totals, [
                'total_hutang' => $total
            ]);
            $lunas = $pemasok->hutangs->sum('lunas');
            array_push($lunass, [
                'lunas' => $lunas
            ]);
            $sisa = $pemasok->hutangs->sum('sisa');
            array_push($sisas, [
                'sisa' => $sisa
            ]);
        }
        // dd($totals);
        return view('pembelian.hutang.hutang', [
           'pemasoks' => $pemasoks,
           'totals' => $totals,
           'lunass' => $lunass,
           'sisas' => $sisas,
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
        $hutangs = Hutang::get()->where('pemasok_id', $id);
        // dd($hutangs);
        return view('pembelian.hutang.hutangdetails', ['hutangs' => $hutangs]);
    }

    public function showpembayaran($id)
    {
        $hutang = Hutang::find($id);
        $retur = $hutang->retur;
        $faktur = $hutang->faktur;
        return response()
        ->json(['success'=> true, 'hutang' => $hutang, 'retur' => $retur, 'faktur' => $faktur]);
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
