<?php

namespace App\Http\Controllers\Penjualan;

use App\Http\Controllers\Controller;

use App\Penjualan\Pemesanan;
use App\Stock\Barang;
use App\Stock\Gudang;
use App\Penjualan\Pelanggan;
use App\Penjualan\Penawaran;
use Illuminate\Http\Request;
use App\Penjualan\Penjual;
use PDF;

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
        $pms = Pemesanan::max('id');
        $pemesanan = Pemesanan::create([
            'kode_pemesanan' => 'PMS-'.$pms,
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
    public function show($id)
    {
        $pemesanan = Pemesanan::find($id);
        $barangs = $pemesanan->barangs;
        $pengirimans = $pemesanan->pengirimans;
        return response()
        ->json(['success'=> true, 'pemesanan' => $pemesanan, 'barangs' => $barangs, 'pengirimans' => $pengirimans ]);
    }
    
    public function detail($id)
    {
        $pemesanan = Pemesanan::find($id);
        $gudang = Gudang::find($pemesanan->gudang);
        $barangs = $pemesanan->barangs;
        $diskon = $pemesanan->diskon.'%';
        $biaya_lain = $pemesanan->biaya_lain;
        $total_seluruh = $pemesanan->total_harga;
        $total_harga = [];
        $subtotal = 0;
        foreach ($barangs as $index => $barang){
            $total_harga[$index] = $barang->pivot->jumlah_barang * $barang->pivot->harga;
            $subtotal += $total_harga[$index];
        }
        // dd($barangs);
        return view('penjualan.penjualan.pemesanan.pemesanandetails', [
            'pemesanan' => $pemesanan, 
            'gudang' => $gudang,
            'barangs' => $barangs,
            'diskon' => $diskon,
            'biaya_lain' => $biaya_lain,
            'total_harga' => $total_harga,
            'subtotal' => $subtotal,
            'total_seluruh' => $total_seluruh,
        ]);
    }

    public function cetak_pdf(Request $request)
    {
        $pemesanan = Pemesanan::find($request->id);
        $gudang = Gudang::find($pemesanan->gudang);
        $barangs = $pemesanan->barangs;
        $diskon = $pemesanan->diskon.'%';
        $biaya_lain = $pemesanan->biaya_lain;
        $total_seluruh = $pemesanan->total_harga;
        $total_harga = [];
        $subtotal = 0;
        foreach ($barangs as $index => $barang){
            $total_harga[$index] = $barang->pivot->jumlah_barang * $barang->pivot->harga;
            $subtotal += $total_harga[$index];
        }
        $pdf = PDF::loadview('penjualan.penjualan.pemesanan.pemesanan-pdf', [
            'pemesanan' => $pemesanan, 
            'gudang' => $gudang,
            'barangs' => $barangs,
            'diskon' => $diskon,
            'biaya_lain' => $biaya_lain,
            'total_harga' => $total_harga,
            'subtotal' => $subtotal,
            'total_seluruh' => $total_seluruh,
            ]);

        return $pdf->download('Pemesanan.pdf');
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
