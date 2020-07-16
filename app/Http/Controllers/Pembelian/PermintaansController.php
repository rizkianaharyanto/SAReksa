<?php

namespace App\Http\Controllers\Pembelian;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Pembelian\Permintaan;
use App\Stock\Barang;
use App\Stock\Gudang;
use App\Pembelian\Pemasok;
use PDF;

class PermintaansController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $permintaans = Permintaan::all();

        return view('pembelian.pembelian.permintaan.permintaan', compact('permintaans'));
    }

    public function laporan()
    {
        $pemasoks = Pemasok::all();
        $permintaans = permintaan::all();
        $supplier = null;
        $start = null;
        $end = null;

        return view('pembelian.pembelian.permintaan.laporan-permintaan', [
            'permintaans' => $permintaans,
            'pemasoks' => $pemasoks,
            'supplier' => $supplier,
            'start' => $start,
            'end' => $end
        ]);
    }

    public function laporanfilter(Request $date)
    {
        if ($date->pemasok_id == null) {
            $pemasoks = Pemasok::all();
            $permintaans = permintaan::all();
            $supplier = null;
            $start = null;
            $end = null;
        } else {
            $pemasoks = Pemasok::all();
            $supplier = Pemasok::find($date->pemasok_id);
            $start = $date->start;
            $end = $date->end;
            $permintaans = permintaan::select("pbl_permintaans.*")
                ->where('pemasok_id', $date->pemasok_id)
                ->whereBetween('tanggal', [$date->start, $date->end])
                ->get();
        }

        return view('pembelian.pembelian.permintaan.laporan-permintaan', [
            'permintaans' => $permintaans,
            'pemasoks' => $pemasoks,
            'supplier' => $supplier,
            'start' => $start,
            'end' => $end
        ]);
    }

    public function cetaklaporan(Request $date)
    {
        if ($date->pemasok_id == null) {
            $pemasoks = Pemasok::all();
            $permintaans = permintaan::all();
            $supplier = null;
            $start = null;
            $end = null;
        } else {
            $pemasoks = Pemasok::all();
            $supplier = Pemasok::find($date->pemasok_id);
            $start = $date->start;
            $end = $date->end;
            $permintaans = permintaan::select("pbl_permintaans.*")
                ->where('pemasok_id', $date->pemasok_id)
                ->whereBetween('tanggal', [$date->start, $date->end])
                ->get();
        }

        $pdf = PDF::loadview('pembelian.pembelian.permintaan.cetak-laporan-permintaan', [
            'permintaans' => $permintaans,
            'pemasoks' => $pemasoks,
            'supplier' => $supplier,
            'start' => $start,
            'end' => $end
        ]);

        return $pdf->download('laporan-permintaan.pdf');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // dd(Gudang::all());
        return view('pembelian.pembelian.permintaan.permintaaninsert', [
            'pemasoks' => Pemasok::all(),
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
        $pr = Permintaan::max('id') + 1;
        $permintaan = Permintaan::create([
            'kode_permintaan' => 'PR-' . $pr,
            'pemasok_id' => $request->pemasok_id,
            'gudang' => $request->gudang,
            'tanggal' => $request->tanggal,
            'diskon' => $request->diskon,
            'diskon_rp' => $request->disk,
            'biaya_lain' => $request->biaya_lain,
            'total_jenis_barang' => 3,
            'total_harga' => $request->total_harga_keseluruhan,
            'status' => 'baru'
        ]);

        foreach ($request->barang_id as $index => $id) {
            $permintaan->barangs()->attach($id, [
                'jumlah_barang' => $request->jumlah_barang[$index],
                'harga' => $request->harga[$index],
                'unit' => $request->unit_barang[$index],
                // 'pajak' => $request->pajak[$index]
            ]);
        }

        return redirect('/pembelian/permintaans');
    }

    /**
     * Display the specified resource.
     *
     * @param int  Permintaan $permintaan
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $permintaan = Permintaan::find($id);
        $barangs = $permintaan->barangs;
        $total_seluruh_pr = $permintaan->total_harga;
        $total_harga_pr = [];
        $subtotal_pr = 0;
        foreach ($barangs as $index => $barang) {
            $total_harga_pr[$index] = $barang->pivot->jumlah_barang * $barang->pivot->harga;
            $subtotal_pr += $total_harga_pr[$index];
        }
        // $unit = $barangs->unit;
        return response()
            ->json([
                'success' => true, 'permintaan' => $permintaan, 'barangs' => $barangs,
                'total_seluruh_pr' => $total_seluruh_pr,
                'total_harga_pr' => $total_harga_pr,
                'subtotal_pr' => $subtotal_pr,
            ]);
    }

    public function show2($id)
    {
        $permintaan = Permintaan::find($id);
        $gudang = Gudang::find($permintaan->gudang);
        $barangs = $permintaan->barangs;
        $diskon = $permintaan->diskon_rp;
        $biaya_lain = $permintaan->biaya_lain;
        $total_seluruh = $permintaan->total_harga;
        $total_harga = [];
        $subtotal = 0;
        foreach ($barangs as $index => $barang) {
            $total_harga[$index] = $barang->pivot->jumlah_barang * $barang->pivot->harga;
            $subtotal += $total_harga[$index];
        }
        // dd($total_harga, $total_seluruh);
        return view('pembelian.pembelian.permintaan.permintaandetails', [
            'permintaan' => $permintaan,
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
        $permintaan = Permintaan::find($request->id);
        $gudang = Gudang::find($permintaan->gudang);
        $barangs = $permintaan->barangs;
        $diskon = $permintaan->diskon_rp;
        $biaya_lain = $permintaan->biaya_lain;
        $total_seluruh = $permintaan->total_harga;
        $total_harga = [];
        $subtotal = 0;
        foreach ($barangs as $index => $barang) {
            $total_harga[$index] = $barang->pivot->jumlah_barang * $barang->pivot->harga;
            $subtotal += $total_harga[$index];
        }
        $pdf = PDF::loadview('pembelian.pembelian.permintaan.permintaan-pdf', [
            'permintaan' => $permintaan,
            'gudang' => $gudang,
            'barangs' => $barangs,
            'diskon' => $diskon,
            'biaya_lain' => $biaya_lain,
            'total_harga' => $total_harga,
            'subtotal' => $subtotal,
            'total_seluruh' => $total_seluruh,
        ]);

        return $pdf->download('permintaan.pdf');
        // return view('pembelian.pembelian.permintaan.permintaan-pdf', [
        //     'permintaan' => $permintaan,
        //     'gudang' => $gudang,
        //     'barangs' => $barangs,
        //     'diskon' => $diskon,
        //     'biaya_lain' => $biaya_lain,
        //     'total_harga' => $total_harga,
        //     'subtotal' => $subtotal,
        //     'total_seluruh' => $total_seluruh,
        //     ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int  Permintaan $permintaan
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Permintaan $permintaan)
    {
        return view('pembelian.pembelian.permintaan.permintaanedit', [
            'permintaan' => $permintaan,
            'pemasoks' => Pemasok::all(),
            'barangs' => Barang::all(),
            'gudangs' => Gudang::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int  Permintaan          $permintaan
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Permintaan $permintaan)
    {
        Permintaan::where('id', $permintaan->id)
            ->update([
                'pemasok_id' => $request->pemasok_id,
                'gudang' => $request->gudang,
                'tanggal' => $request->tanggal,
                'diskon' => $request->diskon,
                'diskon_rp' => $request->disk,
                'biaya_lain' => $request->biaya_lain,
                'total_jenis_barang' => 3,
                'total_harga' => $request->total_harga_keseluruhan,
                'status' => 'baru'
            ]);
        $permintaan->barangs()->detach();
        foreach ($request->barang_id as $index => $id) {
            $permintaan->barangs()->attach($id, [
                'jumlah_barang' => $request->jumlah_barang[$index],
                'harga' => $request->harga[$index],
                'unit' => $request->unit_barang[$index],
                // 'pajak' => $request->pajak[$index]
            ]);
        }

        return redirect('/pembelian/permintaans');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int  Permintaan $permintaan
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Permintaan $permintaan)
    {
        $permintaan->barangs()->detach();
        Permintaan::destroy($permintaan->id);

        return redirect('/pembelian/permintaans');
    }
}
