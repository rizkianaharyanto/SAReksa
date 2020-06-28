<?php

namespace App\Http\Controllers\Penjualan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Penjualan\Penawaran;
use App\Stock\Barang;
use App\Stock\Gudang;
use App\Penjualan\Pelanggan;
use App\Penjualan\Penjual;
use PDF;


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
        session()->flash('message', 'Penawaran berhasil ditambahkan');
        session()->flash('status', 'tambah');
        $pnw = Penawaran::max('id') + 1;
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

    public function detail($id)
    {
        $penawaran = Penawaran::find($id);
        $gudang = Gudang::find($penawaran->gudang);
        $barangs = $penawaran->barangs;
        $diskon = $penawaran->diskon_rp;
        $biaya_lain = $penawaran->biaya_lain;
        $total_seluruh = $penawaran->total_harga;
        $total_harga = [];
        $subtotal = 0;
        foreach ($barangs as $index => $barang){
            $total_harga[$index] = $barang->pivot->jumlah_barang * $barang->pivot->harga;
            $subtotal += $total_harga[$index];
        }
        // dd($total_harga, $total_seluruh);
        return view('penjualan.penjualan.penawaran.penawarandetails', [
            'penawaran' => $penawaran, 
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
        $penawaran = Penawaran::find($request->id);
        $gudang = Gudang::find($penawaran->gudang);
        $barangs = $penawaran->barangs;
        $diskon = $penawaran->diskon_rp;
        $biaya_lain = $penawaran->biaya_lain;
        $total_seluruh = $penawaran->total_harga;
        $total_harga = [];
        $subtotal = 0;
        foreach ($barangs as $index => $barang){
            $total_harga[$index] = $barang->pivot->jumlah_barang * $barang->pivot->harga;
            $subtotal += $total_harga[$index];
        }
        $pdf = PDF::loadview('penjualan.penjualan.penawaran.penawaran-pdf', [
            'penawaran' => $penawaran, 
            'gudang' => $gudang,
            'barangs' => $barangs,
            'diskon' => $diskon,
            'biaya_lain' => $biaya_lain,
            'total_harga' => $total_harga,
            'subtotal' => $subtotal,
            'total_seluruh' => $total_seluruh,
            ]);

        return $pdf->download('Penawaran.pdf');
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
        session()->flash('message', 'Penawaran berhasil diubah');
        session()->flash('status', 'tambah');
        Penawaran::where('id', $penawaran->id)
            ->update([
                'kode_penawaran' => $request->kode_penawaran,
                'pelanggan_id' => $request->pelanggan_id,
                'gudang' => $request->gudang,
                'tanggal' => $request->tanggal,
                'diskon' => $request->diskon,
                'biaya_lain' => $request->biaya_lain,
                'total_jenis_barang' => 3,
                'total_harga' => $request->total_harga_keseluruhan,
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
        session()->flash('message', 'Penawaran berhasil dihapus');
        session()->flash('status', 'hapus');
        Penawaran::destroy($penawaran->id);
        return redirect('/penjualan/penawarans');
    }
}
