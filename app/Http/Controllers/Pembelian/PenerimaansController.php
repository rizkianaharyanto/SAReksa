<?php

namespace App\Http\Controllers\Pembelian;

use App\Http\Controllers\Controller;
use App\Pembelian\Hutang;
use App\Pembelian\Jurnal;
use Illuminate\Http\Request;
use App\Pembelian\Penerimaan;
use App\Pembelian\Pemesanan;
use App\Stock\Barang;
use App\Stock\Gudang;
use App\Pembelian\Pemasok;

class PenerimaansController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $penerimaans = Penerimaan::all();
        return view('pembelian.pembelian.penerimaan.penerimaan', compact('penerimaans'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pembelian.pembelian.penerimaan.penerimaaninsert', [
            'pemasoks' => Pemasok::all(),
            'pemesanans' => Pemesanan::all(),
            'no' => Penerimaan::max('id'),
            'barangs' => Barang::all(),
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
        $penerimaan = Penerimaan::create([
            'kode_penerimaan' => $request->kode_penerimaan,
            'pemesanan_id' => $request->pemesanan_id,
            'status' => $request->status,
            'pemasok_id' => $request->pemasok_id,
            'gudang' => $request->gudang,
            'tanggal' => $request->tanggal,
            'diskon' => $request->diskon,
            'biaya_lain' => $request->biaya_lain,
            'total_jenis_barang' => 3,
            'total_harga' => $request->total_harga_keseluruhan,
        ]);

        for ($i = 1; $i < 3; $i++) {
            if ($i == 1) {
                Jurnal::create([
                    'kode_jurnal' => 'jur',
                    'penerimaan_id' => $penerimaan->id,
                    'debit' => $request->akun_barang,
                    'kredit' => 0,
                    'akun_id' => 1 //barang
                ]);
            }
            if ($i == 2) {
                Jurnal::create([
                    'kode_jurnal' => 'jur',
                    'penerimaan_id' => $penerimaan->id,
                    'debit' => 0,
                    'kredit' => $request->akun_barang,
                    'akun_id' => 2 //barang belum ditagih
                ]);
            }
        }

        $pemesanan = $penerimaan->pemesanan;
        foreach ($request->barang_id as $index => $id) {
            $penerimaan->barangs()->attach($id, [
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
        return redirect('/pembelian/penerimaans');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  Penerimaan $penerimaan
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $penerimaan = Penerimaan::find($id);
        $barangs = $penerimaan->barangs;
        // dd($barangs);
        return response()
            ->json(['success' => true, 'penerimaan' => $penerimaan, 'barangs' => $barangs]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  Penerimaan $penerimaan
     * @return \Illuminate\Http\Response
     */
    public function edit(Penerimaan $penerimaan)
    {
        return view('pembelian.pembelian.penerimaan.penerimaanedit', [
            'penerimaan' => $penerimaan,
            'pemasoks' => Pemasok::all(),
            'barangs' => Barang::all(),
            'gudangs' => Gudang::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  Penerimaan $penerimaan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Penerimaan $penerimaan)
    {
        Penerimaan::where('id', $penerimaan->id)
            ->update([
                'kode_penerimaan' => $request->kode_penerimaan,
                'pemasok_id' => $request->pemasok_id,
                'gudang' => $request->gudang,
                'tanggal' => $request->tanggal,
                'diskon' => $request->diskon,
                'biaya_lain' => $request->biaya_lain,
                'total_jenis_barang' => 3,
                'total_harga' => 1000,
            ]);
        foreach ($request->barang_id as $index => $id) {
            $penerimaan->barangs()->detach($id, [
                'jumlah_barang' => $request->jumlah_barang[$index],
                'harga' => $request->harga[$index]
            ]);
            $penerimaan->barangs()->attach($id, [
                'jumlah_barang' => $request->jumlah_barang[$index],
                'harga' => $request->harga[$index]
            ]);
        }
        return redirect('/pembelian/penerimaans');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  Penerimaan $penerimaan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Penerimaan $penerimaan)
    {
        Penerimaan::destroy($penerimaan->id);
        return redirect('/pembelian/penerimaans');
    }
}
