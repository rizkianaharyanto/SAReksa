<?php

namespace App\Http\Controllers\Penjualan;

use App\Http\Controllers\Controller;
use App\Penjualan\Hutang;
use App\Penjualan\Jurnal;
use Illuminate\Http\Request;
use App\Penjualan\Pengiriman;
use App\Penjualan\Pemesanan;
use App\Stock\Barang;
use App\Stock\Gudang;
use App\Penjualan\Pelanggan;
use App\Penjualan\Penjual;
use PDF;

class PengirimansController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pengirimans = Pengiriman::all();
        return view('penjualan.penjualan.pengiriman.pengiriman', compact('pengirimans'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('penjualan.penjualan.pengiriman.pengirimaninsert', [
            'pelanggans' => Pelanggan::all(),
            'pemesanans' => Pemesanan::all(),
            'barangs' => Barang::all(),
            'penjuals' => Penjual::all(),
            'gudangs' => Gudang::all()
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
        $pgr = Pengiriman::max('id');
        $pengiriman = Pengiriman::create([
            'kode_pengiriman' => 'PGR-'.$pgr,
            'pemesanan_id' => $request->pemesanan_id,
            'status' => $request->status,
            'pelanggan_id' => $request->pelanggan_id,
            'gudang' => $request->gudang,
            'tanggal' => $request->tanggal,
            'diskon' => $request->diskon,
            'diskon_rp' => $request->disk,
            'biaya_lain' => $request->biaya_lain,
            'total_jenis_barang' => 3,
            'penjual_id' => $request->penjual_id,
            'total_harga' => $request->total_harga_keseluruhan,
        ]);

        // dd($jurnal);

        $pemesanan = $pengiriman->pemesanan;
        foreach ($request->barang_id as $index => $id) {
            $pengiriman->barangs()->attach($id, [
                'jumlah_barang' => $request->jumlah_barang[$index],
                'harga' => $request->harga[$index],
                'unit' => $request->unit_barang[$index],
                // 'pajak' => $request->pajak[$index],
            ]);
            $pemesanan->barangs()->where('barang_id', $id)->update(array('status_barang' => 'terkirim'));
            $status = $pemesanan->barangs()->get(array('status_barang'));
            foreach ($status as $status_barang) {
                if (count($request->barang_id) == count($status)) {
                    $pemesanan->update(array('status' => 'terkirim'));
                } else {
                    $pemesanan->update(array('status' => 'terkirim sebagian'));
                }
            }
        }
        return redirect('/penjualan/pengirimans');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Pengiriman  $pengiriman
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pengiriman = Pengiriman::find($id);
        $barangs = $pengiriman->barangs;
        // dd($barangs);
        return response()
            ->json(['success' => true, 'pengiriman' => $pengiriman, 'barangs' => $barangs]);
    }

    public function detail($id)
    {
        $pengiriman = pengiriman::find($id);
        $gudang = Gudang::find($pengiriman->gudang);
        $barangs = $pengiriman->barangs;
        $diskon = $pengiriman->diskon.'%';
        $biaya_lain = $pengiriman->biaya_lain;
        $total_seluruh = $pengiriman->total_harga;
        $total_harga = [];
        $subtotal = 0;
        foreach ($barangs as $index => $barang){
            $total_harga[$index] = $barang->pivot->jumlah_barang * $barang->pivot->harga;
            $subtotal += $total_harga[$index];
        }
        // dd($total_harga, $total_seluruh);
        return view('penjualan.penjualan.pengiriman.pengirimandetails', [
            'pengiriman' => $pengiriman, 
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
        $pengiriman = pengiriman::find($request->id);
        $gudang = Gudang::find($pengiriman->gudang);
        $barangs = $pengiriman->barangs;
        $diskon = $pengiriman->diskon.'%';
        $biaya_lain = $pengiriman->biaya_lain;
        $total_seluruh = $pengiriman->total_harga;
        $total_harga = [];
        $subtotal = 0;
        foreach ($barangs as $index => $barang){
            $total_harga[$index] = $barang->pivot->jumlah_barang * $barang->pivot->harga;
            $subtotal += $total_harga[$index];
        }
        $pdf = PDF::loadview('penjualan.penjualan.pengiriman.pengiriman-pdf', [
            'pengiriman' => $pengiriman, 
            'gudang' => $gudang,
            'barangs' => $barangs,
            'diskon' => $diskon,
            'biaya_lain' => $biaya_lain,
            'total_harga' => $total_harga,
            'subtotal' => $subtotal,
            'total_seluruh' => $total_seluruh,
            ]);

        return $pdf->download('Pengiriman.pdf');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Pengiriman  $pengiriman
     * @return \Illuminate\Http\Response
     */
    public function edit(Pengiriman $pengiriman)
    {
        return view('penjualan.penjualan.pengiriman.pengirimanedit', [
            'pengiriman' => $pengiriman,
            'pelanggans' => Pelanggan::all(),
            'barangs' => Barang::all(),
            'penjuals' => Penjual::all(),
            'gudangs' => Gudang::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Pengiriman  $pengiriman
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pengiriman $pengiriman)
    {
        Pengiriman::where('id', $pengiriman->id)
            ->update([
                'kode_pengiriman' => $request->kode_pengiriman,
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
            $pengiriman->barangs()->detach($id, [
                'jumlah_barang' => $request->jumlah_barang[$index],
                'harga' => $request->harga[$index]
            ]);
            $pengiriman->barangs()->attach($id, [
                'jumlah_barang' => $request->jumlah_barang[$index],
                'harga' => $request->harga[$index]
            ]);
        }
        return redirect('/penjualan/pengirimans');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Pengiriman  $pengiriman
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pengiriman $pengiriman)
    {
        Pengiriman::destroy($pengiriman->id);
        return redirect('/penjualan/pengirimans');
    }
}
