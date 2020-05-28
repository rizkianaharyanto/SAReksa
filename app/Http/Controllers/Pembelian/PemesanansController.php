<?php

namespace App\Http\Controllers\Pembelian;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Pembelian\Pemesanan;
use App\Stock\Barang;
use App\Stock\Gudang;
use App\Pembelian\Pemasok;
use App\Pembelian\Permintaan;

class PemesanansController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pemesanans = Pemesanan::all();
        return view('pembelian.pembelian.pemesanan.pemesanan', compact('pemesanans'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pembelian.pembelian.pemesanan.pemesananinsert', [
            'pemasoks' => Pemasok::all(),
            'permintaans' => Permintaan::all(),
            // 'barangs' => Barang::all(),
            // 'gudangs'=> Gudang::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $pemesanan = Pemesanan::create([
            'kode_pemesanan' => $request->kode_pemesanan,
            'pemasok_id' => $request->pemasok_id,
            'gudang' => $request->gudang,
            'tanggal' => $request->tanggal,
            'diskon' => $request->diskon,
            'biaya_lain' => $request->biaya_lain,
            'total_jenis_barang' => 3,
            'total_harga' => 1000,
            'permintaan_id' => $request->permintaan_id,
        ]);

        foreach ($request->barang_id as $index => $id) {

            $pemesanan->barangs()->attach($id, [
                'jumlah_barang' => $request->jumlah_barang[$index],
                'harga' => $request->harga[$index]
            ]);
        }
        return redirect('/pemesanans');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  Pemesanan $pemesanan
     * @return \Illuminate\Http\Response
     */
    public function show(Pemesanan $pemesanan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  Pemesanan $pemesanan
     * @return \Illuminate\Http\Response
     */
    public function edit(Pemesanan $pemesanan)
    {
        return view('pembelian.pembelian.pemesanan.pemesananedit', [
            'pemesanan' => $pemesanan,
            'pemasoks' => Pemasok::all(),
            'permintaans' => Permintaan::all(),
            // 'barangs' => Barang::all(),
            // 'gudangs'=> Gudang::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  Pemesanan $pemesanan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pemesanan $pemesanan)
    {
        Pemesanan::where('id', $pemesanan->id)
            ->update([
                'kode_pemesanan' => $request->kode_pemesanan,
                'pemasok_id' => $request->pemasok_id,
                'gudang' => $request->gudang,
                'tanggal' => $request->tanggal,
                'diskon' => $request->diskon,
                'biaya_lain' => $request->biaya_lain,
                'total_jenis_barang' => 3,
                'total_harga' => 1000,
            ]);
        foreach ($request->barang_id as $index => $id) {
            $pemesanan->barangs()->detach($id, [
                'jumlah_barang' => $request->jumlah_barang[$index],
                'harga' => $request->harga[$index]
            ]);
            $pemesanan->barangs()->attach($id, [
                'jumlah_barang' => $request->jumlah_barang[$index],
                'harga' => $request->harga[$index]
            ]);
        }
        return redirect('/pemesanans');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  Pemesanan $pemesanan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pemesanan $pemesanan)
    {
        Pemesanan::destroy($pemesanan->id);
        return redirect('/pemesanans');
    }
}
