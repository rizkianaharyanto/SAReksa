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
            'no' => Pengiriman::max('id'),
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
        $pengiriman = Pengiriman::create([
            'kode_pengiriman' => $request->kode_pengiriman,
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

        $no= Jurnal::max('id') + 1;
        for ($i = 1; $i < 3; $i++) {
            $jurnal= Jurnal::create([
                'kode_jurnal' => 'jur'+$no,
                'pengiriman_id' => $pengiriman->id,
                'debit' => 0,
                'kredit' => 0
            ]);
            if ($i == 1) {
                $jurnal->update([
                    'debit' => $request->akun_barang,
                    'akun_id' => 1 //barang
                ]);
            }else if ($i == 2) {
                $jurnal->update([
                    'kredit' => $request->akun_barang,
                    'akun_id' => 2 //barang belum ditagih
                ]);
            }
        }
        // dd($jurnal);

        $pemesanan = $pengiriman->pemesanan;
        foreach ($request->barang_id as $index => $id) {
            $pengiriman->barangs()->attach($id, [
                'jumlah_barang' => $request->jumlah_barang[$index],
                'harga' => $request->harga[$index],
                'unit' => $request->unit_barang[$index],
                // 'pajak' => $request->pajak[$index],
            ]);
            $pemesanan->barangs()->where('barang_id', $id)->update(array('status_barang' => 'diterima'));
            $status = $pemesanan->barangs()->get(array('status_barang'));
            foreach ($status as $status_barang) {
                if (count($request->barang_id) == count($status)) {
                    $pemesanan->update(array('status' => 'diterima'));
                } else {
                    $pemesanan->update(array('status' => 'diterima sebagian'));
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
