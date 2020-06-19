<?php

namespace App\Http\Controllers\Pembelian;

use App\Http\Controllers\Controller;
use App\Pembelian\Jurnal;
use Illuminate\Http\Request;
use App\Pembelian\Penerimaan;
use App\Pembelian\Pemesanan;
use App\Stock\Barang;
use App\Stock\Gudang;
use App\Pembelian\Pemasok;
use PDF;

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
        $pnm = Penerimaan::max('id') + 1;
        $penerimaan = Penerimaan::create([
            'kode_penerimaan' => 'PNM-'.$pnm,
            'pemesanan_id' => $request->pemesanan_id,
            'status' => $request->status,
            'pemasok_id' => $request->pemasok_id,
            'gudang' => $request->gudang,
            'tanggal' => $request->tanggal,
            'diskon' => $request->diskon,
            'diskon_rp' => $request->disk,
            'biaya_lain' => $request->biaya_lain,
            'total_jenis_barang' => 3,
            'total_harga' => $request->total_harga_keseluruhan,
        ]);

        $no = Jurnal::max('id') + 1;
        for ($i = 1; $i < 3; ++$i) {
            $jurnal = Jurnal::create([
                'kode_jurnal' => 'jur'.$no,
                'penerimaan_id' => $penerimaan->id,
                'debit' => 0,
                'kredit' => 0,
            ]);
            if ($i == 1) {
                $jurnal->update([
                    'debit' => $request->akun_barang,
                    'akun_id' => 1, //barang
                ]);
            } elseif ($i == 2) {
                $jurnal->update([
                    'kredit' => $request->akun_barang,
                    'akun_id' => 2, //barang belum ditagih
                ]);
            }
        }
        // dd($jurnal);

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
     * @param int  Penerimaan $penerimaan
     *
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

    public function show2($id)
    {
        $penerimaan = penerimaan::find($id);
        $gudang = Gudang::find($penerimaan->gudang);
        $barangs = $penerimaan->barangs;
        $diskon = $penerimaan->diskon.'%';
        $biaya_lain = $penerimaan->biaya_lain;
        $total_seluruh = $penerimaan->total_harga;
        $total_harga = [];
        $subtotal = 0;
        foreach ($barangs as $index => $barang) {
            $total_harga[$index] = $barang->pivot->jumlah_barang * $barang->pivot->harga;
            $subtotal += $total_harga[$index];
        }
        // dd($total_harga, $total_seluruh);
        return view('pembelian.pembelian.penerimaan.penerimaandetails', [
            'penerimaan' => $penerimaan,
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
        $penerimaan = penerimaan::find($request->id);
        $gudang = Gudang::find($penerimaan->gudang);
        $barangs = $penerimaan->barangs;
        $diskon = $penerimaan->diskon.'%';
        $biaya_lain = $penerimaan->biaya_lain;
        $total_seluruh = $penerimaan->total_harga;
        $total_harga = [];
        $subtotal = 0;
        foreach ($barangs as $index => $barang) {
            $total_harga[$index] = $barang->pivot->jumlah_barang * $barang->pivot->harga;
            $subtotal += $total_harga[$index];
        }
        $pdf = PDF::loadview('pembelian.pembelian.penerimaan.penerimaan-pdf', [
            'penerimaan' => $penerimaan,
            'gudang' => $gudang,
            'barangs' => $barangs,
            'diskon' => $diskon,
            'biaya_lain' => $biaya_lain,
            'total_harga' => $total_harga,
            'subtotal' => $subtotal,
            'total_seluruh' => $total_seluruh,
            ]);

        return $pdf->download('penerimaan.pdf');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int  Penerimaan $penerimaan
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Penerimaan $penerimaan)
    {
        return view('pembelian.pembelian.penerimaan.penerimaanedit', [
            'penerimaan' => $penerimaan,
            'pemasoks' => Pemasok::all(),
            'barangs' => Barang::all(),
            'gudangs' => Gudang::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int  Penerimaan          $penerimaan
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Penerimaan $penerimaan)
    {
        Penerimaan::where('id', $penerimaan->id)
            ->update([
                'diskon' => $request->diskon,
                'diskon_rp' => $request->disk,
                'biaya_lain' => $request->biaya_lain,
                'total_jenis_barang' => 3,
                'total_harga' => $request->total_harga_keseluruhan,
            ]);
        $pemesanan = $penerimaan->pemesanan;
        $penerimaan->barangs()->detach();
        foreach ($request->barang_id as $index => $id) {
            $penerimaan->barangs()->attach($id, [
                'jumlah_barang' => $request->jumlah_barang[$index],
                'harga' => $request->harga[$index],
                'unit' => $request->unit_barang[$index],
                // 'pajak' => $request->pajak[$index],
            ]);
            $pemesanan->barangs()->where('barang_id', $id)->update(array('status_barang' => 'diterima'));
            // $status = $pemesanan->barangs()->get(array('status_barang'));
            // foreach ($status as $status_barang) {
            //     if (count($request->barang_id) == count($status)) {
            //         $pemesanan->update(array('status' => 'diterima'));
            //     } else {
            //         $pemesanan->update(array('status' => 'diterima sebagian'));
            //     }
            // }
        }

        // for ($i = 1; $i < 3; ++$i) {
        //     $jurnal = $penerimaan->jurnals();
        //     dd($jurnal);
        //     if ($i == 1) {
        //         $jurnal->update([
        //             'debit' => $request->akun_barang,
        //             'akun_id' => 1, //barang
        //         ]);
        //     } elseif ($i == 2) {
        //         $jurnal->update([
        //             'kredit' => $request->akun_barang,
        //             'akun_id' => 2, //barang belum ditagih
        //         ]);
        //     }
        // }

        return redirect('/pembelian/penerimaans');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int  Penerimaan $penerimaan
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Penerimaan $penerimaan)
    {
        Penerimaan::destroy($penerimaan->id);

        return redirect('/pembelian/penerimaans');
    }
}
