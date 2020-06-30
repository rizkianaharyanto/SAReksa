<?php

namespace App\Http\Controllers\Pembelian;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Pembelian\Pemesanan;
use App\Stock\Barang;
use App\Stock\Gudang;
use App\Pembelian\Pemasok;
use App\Pembelian\Permintaan;
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

        return view('pembelian.pembelian.pemesanan.pemesanan', compact('pemesanans'));
    }

    public function laporan()
    {
        $pemesanans = Pemesanan::all();

        return view('pembelian.pembelian.pemesanan.laporan-pemesanan', compact('pemesanans'));
    }

    public function laporanfilter(Request $date)
    {
        $pemesanans = Pemesanan::select("pbl_pemesanans.*")
            ->whereBetween('tanggal', [$date->start, $date->end])
            ->get();

            return view('pembelian.pembelian.pemesanan.laporan-pemesanan', compact('pemesanans'));
    }

    public function cetaklaporan()
    {
        $pemesanans = Pemesanan::all();

        $pdf = PDF::loadview('pembelian.pembelian.pemesanan.cetak-laporan-pemesanan', compact('pemesanans'));

        return $pdf->download('laporan-pemesanan.pdf');
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
            'barangs' => Barang::all(),
            'gudangs' => Gudang::all(),
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
        $psn = Pemesanan::max('id') + 1;
        $pemesanan = Pemesanan::create([
            'kode_pemesanan' => 'PSN-'.$psn,
            'pemasok_id' => $request->pemasok_id,
            'gudang' => $request->gudang,
            'tanggal' => $request->tanggal,
            'diskon' => $request->diskon,
            'diskon_rp' => $request->disk,
            'biaya_lain' => $request->biaya_lain,
            'total_jenis_barang' => 3,
            'total_harga' => $request->total_harga_keseluruhan,
            'permintaan_id' => $request->permintaan_id,
            'status' => $request->status,
        ]);

        foreach ($request->barang_id as $index => $id) {
            $pemesanan->barangs()->attach($id, [
                'jumlah_barang' => $request->jumlah_barang[$index],
                'barang_belum_diterima' => $request->jumlah_barang[$index],
                'harga' => $request->harga[$index],
                'unit' => $request->unit_barang[$index],
                // 'pajak' => $request->pajak[$index],
                'status_barang' => 'belum diterima',
            ]);
        }

        return redirect('/pembelian/pemesanans');
    }

    /**
     * Display the specified resource.
     *
     * @param int  Pemesanan $pemesanan
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pemesanan = Pemesanan::find($id);
        $barangs = $pemesanan->barangs()->wherePivot('status_barang', 'belum diterima')->get();
        $barangsfak = $pemesanan->barangs;
        $penerimaans = $pemesanan->penerimaans;
        $total_seluruh_psn = $pemesanan->total_harga;
        $total_harga_psn = [];
        $subtotal_psn = 0;
        foreach ($barangs as $index => $barang) {
            $total_harga_psn[$index] = $barang->pivot->jumlah_barang * $barang->pivot->harga;
            $subtotal_psn += $total_harga_psn[$index];
        }
        $total_seluruh_psnfak = $pemesanan->total_harga;
        $total_harga_psnfak = [];
        $subtotal_psnfak = 0;
        foreach ($barangsfak as $index => $barang) {
            $total_harga_psnfak[$index] = $barang->pivot->jumlah_barang * $barang->pivot->harga;
            $subtotal_psnfak += $total_harga_psnfak[$index];
        }

        return response()
        ->json(['success' => true, 'pemesanan' => $pemesanan, 'barangs' => $barangs, 'barangsfak' => $barangsfak, 'penerimaans' => $penerimaans,
        'total_seluruh_psn' => $total_seluruh_psn,
        'total_harga_psn' => $total_harga_psn,
        'subtotal_psn' => $subtotal_psn,
        'total_seluruh_psnfak' => $total_seluruh_psnfak,
        'total_harga_psnfak' => $total_harga_psnfak,
        'subtotal_psnfak' => $subtotal_psnfak,
        ]);
    }

    public function show2($id)
    {
        $pemesanan = pemesanan::find($id);
        $gudang = Gudang::find($pemesanan->gudang);
        $barangs = $pemesanan->barangs;
        $diskon = $pemesanan->diskon_rp;
        $biaya_lain = $pemesanan->biaya_lain;
        $total_seluruh = $pemesanan->total_harga;
        $total_harga = [];
        $subtotal = 0;
        foreach ($barangs as $index => $barang) {
            $total_harga[$index] = $barang->pivot->jumlah_barang * $barang->pivot->harga;
            $subtotal += $total_harga[$index];
        }
        // dd($barangs);
        return view('pembelian.pembelian.pemesanan.pemesanandetails', [
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
        $pemesanan = pemesanan::find($request->id);
        $gudang = Gudang::find($pemesanan->gudang);
        $barangs = $pemesanan->barangs;
        $diskon = $pemesanan->diskon_rp;
        $biaya_lain = $pemesanan->biaya_lain;
        $total_seluruh = $pemesanan->total_harga;
        $total_harga = [];
        $subtotal = 0;
        foreach ($barangs as $index => $barang) {
            $total_harga[$index] = $barang->pivot->jumlah_barang * $barang->pivot->harga;
            $subtotal += $total_harga[$index];
        }
        $pdf = PDF::loadview('pembelian.pembelian.pemesanan.pemesanan-pdf', [
            'pemesanan' => $pemesanan,
            'gudang' => $gudang,
            'barangs' => $barangs,
            'diskon' => $diskon,
            'biaya_lain' => $biaya_lain,
            'total_harga' => $total_harga,
            'subtotal' => $subtotal,
            'total_seluruh' => $total_seluruh,
            ]);

        return $pdf->download('pemesanan.pdf');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int  Pemesanan $pemesanan
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Pemesanan $pemesanan)
    {
        return view('pembelian.pembelian.pemesanan.pemesananedit', [
            'pemesanan' => $pemesanan,
            'pemasoks' => Pemasok::all(),
            'permintaans' => Permintaan::all(),
            'barangs' => Barang::all(),
            'gudangs' => Gudang::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int  Pemesanan           $pemesanan
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pemesanan $pemesanan)
    {
        Pemesanan::where('id', $pemesanan->id)
            ->update([
                'pemasok_id' => $request->pemasok_id,
                'gudang' => $request->gudang,
                'tanggal' => $request->tanggal,
                'diskon' => $request->diskon,
                'diskon_rp' => $request->disk,
                'biaya_lain' => $request->biaya_lain,
                'total_jenis_barang' => 3,
                'total_harga' => $request->total_harga_keseluruhan,
                'permintaan_id' => $request->permintaan_id,
                'status' => $request->status,
            ]);
        $pemesanan->barangs()->detach();
        foreach ($request->barang_id as $index => $id) {
            $pemesanan->barangs()->attach($id, [
                'jumlah_barang' => $request->jumlah_barang[$index],
                'barang_belum_diterima' => $request->jumlah_barang[$index],
                'harga' => $request->harga[$index],
                'unit' => $request->unit_barang[$index],
                // 'pajak' => $request->pajak[$index],
                'status_barang' => $request->status_barang[$index],
            ]);
        }

        return redirect('/pembelian/pemesanans');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int  Pemesanan $pemesanan
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pemesanan $pemesanan)
    {
        Pemesanan::destroy($pemesanan->id);

        return redirect('/pembelian/pemesanans');
    }
}
