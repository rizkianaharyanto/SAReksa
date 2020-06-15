<?php

namespace App\Http\Controllers\Penjualan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Penjualan\Penawaran;
use App\Stock\Barang;
use App\Stock\Gudang;
use App\Penjualan\Pelanggan;
use App\Penjualan\Penjual;


class PenawaransController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $penawarans = Penawaran::all();
        return view('penjualan.penjualan.penawaran.penawaran', compact('penawarans'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('penjualan.penjualan.penawaran.penawaraninsert', [
            'pelanggans' => Pelanggan::all(),
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
        $pnw = Penawaran::max('id');
        $penawaran = Penawaran::create([
            'kode_penawaran' => 'PNW-'.$pnw,
            'pelanggan_id' => $request->pelanggan_id,
            'gudang' => $request->gudang,
            'tanggal' => $request->tanggal,
            'diskon' => $request->diskon,
            'diskon_rp' => $request->disk,
            'biaya_lain' => $request->biaya_lain,
            'total_jenis_barang' => 3,
            'total_harga' => $request->total_harga_keseluruhan,
            'penjual_id' => $request->penjual_id,
        ]);

        foreach ($request->barang_id as $index => $id) {

            $penawaran->barangs()->attach($id, [
                'jumlah_barang' => $request->jumlah_barang[$index],
                'harga' => $request->harga[$index],
                'unit' => $request->unit_barang[$index],
                // 'pajak' => $request->pajak[$index]
            ]);
        }
        return redirect('/penjualan/penawarans');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Penawaran  $penawaran
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $penawaran = Penawaran::find($id);
        $barangs = $penawaran->barangs;
        // $unit = $barangs->unit;
        return response()
        ->json(['success'=> true, 'penawaran' => $penawaran, 'barangs' => $barangs]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Penawaran  $penawaran
     * @return \Illuminate\Http\Response
     */
    public function edit(Penawaran $penawaran)
    {
        // dd($penawaran->barangs);
        return view('penjualan.penjualan.penawaran.penawaranedit', [
            'penawaran' => $penawaran,
            'pelanggans' => Pelanggan::all(),
            'penjuals' => Penjual::all(),
            'barangs' => Barang::all(),
            'gudangs' => Gudang::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Penawaran  $penawaran
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Penawaran $penawaran)
    {
        Penawaran::where('id', $penawaran->id)
            ->update([
                'kode_penawaran' => $request->kode_penawaran,
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
            $penawaran->barangs()->detach($id, [
                'jumlah_barang' => $request->jumlah_barang[$index],
                'harga' => $request->harga[$index],
                'unit' => $request->unit_barang[$index],
                // 'pajak' => $request->pajak[$index]
            ]);
            $penawaran->barangs()->attach($id, [
                'jumlah_barang' => $request->jumlah_barang[$index],
                'harga' => $request->harga[$index],
                'unit' => $request->unit_barang[$index],
                // 'pajak' => $request->pajak[$index]
            ]);
        }
        return redirect('/penjualan/penawarans');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Penawaran  $penawaran
     * @return \Illuminate\Http\Response
     */
    public function destroy(Penawaran $penawaran)
    {
        Penawaran::destroy($penawaran->id);
        return redirect('/penjualan/penawarans');
    }
}
