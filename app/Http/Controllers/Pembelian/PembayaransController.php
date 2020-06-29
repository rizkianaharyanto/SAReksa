<?php

namespace App\Http\Controllers\Pembelian;

use App\Http\Controllers\Controller;
use App\Pembelian\Hutang;
use App\Pembelian\Jurnal;
use App\Pembelian\Pemasok;
use Illuminate\Http\Request;
use App\Pembelian\Pembayaran;

class PembayaransController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pembayarans = Pembayaran::all();

        return view('pembelian.hutang.pembayaran', compact('pembayarans'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pemasoks = Pemasok::all();
        $hutangs = Hutang::all();

        return view('pembelian.hutang.pembayaraninsert', [
            'pemasoks' => $pemasoks,
            'hutangs' => $hutangs,
        ]);
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
        $byr = Pembayaran::max('id') + 1;
        $pembayaran = Pembayaran::create([
            'kode_pembayaran' => 'BYR-'.$byr,
            'pemasok_id' => $request->pemasok_id,
            'tanggal' => $request->tanggal,
            'total' => $request->total_harga,
        ]);

        $no = Jurnal::max('id') + 1;
        for ($i = 1; $i < 3; ++$i) {
            $jurnal = Jurnal::create([
                'kode_jurnal' => 'jur'.$no,
                'pembayaran_id' => $pembayaran->id,
                'debit' => 0,
                'kredit' => 0,
            ]);
            if ($i == 1) {
                $jurnal->update([
                    'debit' => $request->total_harga,
                    'akun_id' => 4, //hutang
                ]);
            } elseif ($i == 2) {
                $jurnal->update([
                    'kredit' => $request->total_harga,
                    'akun_id' => 6, //kas
                ]);
            }
        }

        foreach ($request->hutang_id as $index => $id) {
            $hutang = Hutang::find($id);
            $sisa = $hutang->sisa - $request->total[$index];
            $hutang->update([
                'lunas' => $request->total[$index],
                'sisa' => $sisa,
            ]);
            if ($sisa == 0){
                $hutang->update([
                    'status' => 'lunas',
                ]);
                $hutang->faktur()->update([
                    'status' => 'lunas',
                ]);
            }else{
                $hutang->faktur()->update([
                    'status' => 'dibayar sebagian',
                ]);
            }
            // if ($hutang->faktur_id) {
            //     $hutang->faktur()->update([
            //         'status' => 'lunas',
            //     ]);
            // } elseif ($hutang->retur_id) {
            //     $hutang->retur()->update([
            //         'status' => 'lunas',
            //     ]);
            // }
        }

        foreach ($request->hutang_id as $index => $id) {
            $pembayaran->hutangs()->attach($id, [
                'total' => $request->total_hutang[$index],
            ]);
        }

        return redirect('/pembelian/pembayarans');
    }

    /**
     * Display the specified resource.
     *
     * @param int  Pembayaran $pembayaran
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int  Pembayaran $pembayaran
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Pembayaran $pembayaran)
    {
        return view('pembelian.hutang.pembayaranedit', [
            'pembayaran' => $pembayaran,
            'pemasoks' => Pemasok::all(),
            'hutangs' => Hutang::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int  Pembayaran          $pembayaran
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pembayaran $pembayaran)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int  Pembayaran $pembayaran
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pembayaran $pembayaran)
    {
        Pembayaran::destroy($pembayaran->id);

        return redirect('/pembelian/pembayarans');
    }
}
