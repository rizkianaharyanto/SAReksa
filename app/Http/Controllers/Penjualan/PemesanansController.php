<?php

namespace App\Http\Controllers\Penjualan;

use App\Http\Controllers\Controller;

use App\Pembelian\Pemesanan;
use App\Stock\Barang;
use App\Stock\Gudang;
use App\Pembelian\Pelanggan;
use App\Pembelian\Penawaran;
use Illuminate\Http\Request;
use App\Penjualan\Penjual;

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
        return view('penjualan.penjualan.pemesanan.pemesanan', compact('pemesanans'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('penjualan.penjualan.pemesanan.pemesananinsert', [
            'pelanggans' => Pelanggan::all(),
            'penawarans' => Penawaran::all(),
            'no' => Pemesanan::max('id'),
            'barangs' => Barang::all(),
            'gudangs'=> Gudang::all(),
            'penjuals' => Penjual::all()
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
            'pelanggan_id' => $request->pelanggan_id,
            'gudang' => $request->gudang,
            'tanggal' => $request->tanggal,
            'diskon' => $request->diskon,
            'diskon_rp' => $request->disk,
            'biaya_lain' => $request->biaya_lain,
            'total_jenis_barang' => 3,
            'total_harga' => $request->total_harga_keseluruhan,
            'penawaran_id' => $request->penawaran_id,
            'status' => $request->status,
            'penjual_id' => $request->penjual_id,
        ]);

        foreach ($request->barang_id as $index => $id) {

            $pemesanan->barangs()->attach($id, [
                'jumlah_barang' => $request->jumlah_barang[$index],
                'harga' => $request->harga[$index],
                'unit' => $request->unit_barang[$index],
                // 'pajak' => $request->pajak[$index],
                'status_barang' => $request->status_barang[$index],
            ]);
        }
        return redirect('/penjualan/pemesanans');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Pemesanan  $pemesanan
     * @return \Illuminate\Http\Response
     */
    public function show(Pemesanan $pemesanan)
    {
        $pemesanan = Pemesanan::find($id);
        $barangs = $pemesanan->barangs;
        $penerimaans = $pemesanan->penerimaans;
        return response()
        ->json(['success'=> true, 'pemesanan' => $pemesanan, 'barangs' => $barangs, 'pengirimans' => $pengirimans ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Pemesanan  $pemesanan
     * @return \Illuminate\Http\Response
     */
    public function edit(Pemesanan $pemesanan)
    {
        return view('penjualan.penjualan.pemesanan.pemesananedit', [
            'pemesanan' => $pemesanan,
            'pelanggans' => Pelanggan::all(),
            'penawarans' => Penawaran::all(),
            'barangs' => Barang::all(),
            'gudangs'=> Gudang::all(),
            'penjuals' => Penjual::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Pemesanan  $pemesanan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pemesanan $pemesanan)
    {
        Pemesanan::where('id', $pemesanan->id)
            ->update([
                'kode_pemesanan' => $request->kode_pemesanan,
                'pelanggan_id' => $request->pelanggan_id,
                'gudang' => $request->gudang,
                'tanggal' => $request->tanggal,
                'diskon' => $request->diskon,
                'biaya_lain' => $request->biaya_lain,
                'total_jenis_barang' => 3,
                'total_harga' => 1000,
                'penjual_id' => $request->penjual_id,
                ]);
        foreach ($request->barang_id as $index => $id) {
            $pemesanan->barangs()->detach($id, [
                'jumlah_barang' => $request->jumlah_barang[$index],
                'harga' => $request->harga[$index],
                'unit' => $request->unit_barang[$index],
                // 'pajak' => $request->pajak[$index],
                'status_barang' => $request->status_barang[$index],
            ]);
            $pemesanan->barangs()->attach($id, [
                'jumlah_barang' => $request->jumlah_barang[$index],
                'harga' => $request->harga[$index],
                'unit' => $request->unit_barang[$index],
                // 'pajak' => $request->pajak[$index],
                'status_barang' => $request->status_barang[$index],
            ]);
        }
        return redirect('/penjualan/pemesanans');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Pemesanan  $pemesanan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pemesanan $pemesanan)
    {
        Pemesanan::destroy($pemesanan->id);
        return redirect('/penjualan/pemesanans');
    }
}
