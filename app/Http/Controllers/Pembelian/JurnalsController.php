<?php

namespace App\Http\Controllers\Pembelian;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Pembelian\Jurnal;
use App\Pembelian\Pemasok;
use PDF;

class JurnalsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jurnals = Jurnal::all()->groupBy('kode_jurnal');
        $debit = 0;
        $kredit = 0;
        $transaksi= null;
        $start = null;
        $end = null;
        foreach (Jurnal::all() as $jurnal) {
            $debit += $jurnal->debit;
            $kredit += $jurnal->kredit;
        }
        return view('pembelian.jurnal', [
            'jurnals' => $jurnals,
            'debit' => $debit,
            'kredit' => $kredit,
            'transaksi' => $transaksi,
            'start' => $start,
            'end' => $end
        ]);
    }
    
    public function filter(Request $date)
    {
        if ($date->transaksi == null) {
            if($date->start == null){
                $jurnals = Jurnal::all()->groupBy('kode_jurnal');
                $debit = 0;
                $kredit = 0;
                $transaksi= null;
                $start = null;
                $end = null;
                foreach (Jurnal::all() as $jurnal) {
                    $debit += $jurnal->debit;
                    $kredit += $jurnal->kredit;
                }
            }else{
                $jurnals = Jurnal::select("pbl_jurnals.*")->whereBetween('tanggal', [$date->start, $date->end])->get()->groupBy('kode_jurnal');
                // dd($jurnals);
                $debit = 0;
                $kredit = 0;
                $transaksi= null;
                $start = $date->start;
                $end = $date->end;
                foreach (Jurnal::all() as $jurnal) {
                    $debit += $jurnal->debit;
                    $kredit += $jurnal->kredit;
                }
            }
        }else{
            if($date->start == null){
                $transaksi= $date->transaksi;
                if($date->transaksi == 'Penerimaan Barang'){
                    $jurnals = Jurnal::select('pbl_jurnals.*')->where('penerimaan_id', '!=', null)->get();
                }elseif($date->transaksi == 'Faktur'){
                    $jurnals = Jurnal::select('pbl_jurnals.*')->where('faktur_id', '!=', null)->get();
                }elseif($date->transaksi == 'Retur'){
                    $jurnals = Jurnal::select('pbl_jurnals.*')->where('retur_id', '!=', null)->get();
                }elseif($date->transaksi == 'Pembayaran Hutang'){
                    $jurnals = Jurnal::select('pbl_jurnals.*')->where('pembayaran_id', '!=', null)->get();
                }
                $debit = 0;
                $kredit = 0;
                $start = null;
                $end = null;
                foreach ($jurnals as $jurnal) {
                    $debit += $jurnal->debit;
                    $kredit += $jurnal->kredit;
                }
            }else{
                $transaksi= $date->transaksi;
                if($date->transaksi == 'Penerimaan Barang'){
                    $jurnals = Jurnal::select('pbl_jurnals.*')->where('penerimaan_id', '!=', null)->whereBetween('tanggal', [$date->start, $date->end])->get();
                    // dd($jurnals);
                }elseif($date->transaksi == 'Faktur'){
                    $jurnals = Jurnal::select('pbl_jurnals.*')->where('faktur_id', '!=', null)->whereBetween('tanggal', [$date->start, $date->end])->get();
                }elseif($date->transaksi == 'Retur'){
                    $jurnals = Jurnal::select('pbl_jurnals.*')->where('retur_id', '!=', null)->whereBetween('tanggal', [$date->start, $date->end])->get();
                }elseif($date->transaksi == 'Pembayaran Hutang'){
                    $jurnals = Jurnal::select('pbl_jurnals.*')->where('pembayaran_id', '!=', null)->whereBetween('tanggal', [$date->start, $date->end])->get();
                }
                $debit = 0;
                $kredit = 0;
                $start = $date->start;
                $end = $date->end;
                foreach ($jurnals as $jurnal) {
                    $debit += $jurnal->debit;
                    $kredit += $jurnal->kredit;
                }
            }
        }
        return view('pembelian.jurnal', [
            'jurnals' => $jurnals,
            'debit' => $debit,
            'kredit' => $kredit,
            'transaksi' => $transaksi,
            'start' => $start,
            'end' => $end
        ]);
    }

    public function cetak_pdf(Request $date)
    {
        if ($date->transaksi == null) {
            $jurnals = Jurnal::all()->groupBy('kode_jurnal');
            $debit = 0;
            $kredit = 0;
            $transaksi= null;
            // dd($jurnals);
            foreach (Jurnal::all() as $jurnal) {
                $debit += $jurnal->debit;
                $kredit += $jurnal->kredit;
            }
        }else{
            $transaksi= $date->transaksi;
            if($date->transaksi == 'Penerimaan Barang'){
                $jurnals = Jurnal::select('pbl_jurnals.*')->where('penerimaan_id', '!=', null)->get();
            }elseif($date->transaksi == 'Faktur'){
                $jurnals = Jurnal::select('pbl_jurnals.*')->where('faktur_id', '!=', null)->get();
            }elseif($date->transaksi == 'Retur'){
                $jurnals = Jurnal::select('pbl_jurnals.*')->where('retur_id', '!=', null)->get();
            }elseif($date->transaksi == 'Pembayaran Hutang'){
                $jurnals = Jurnal::select('pbl_jurnals.*')->where('pembayaran_id', '!=', null)->get();
            }
            $debit = 0;
            $kredit = 0;
            foreach ($jurnals as $jurnal) {
                $debit += $jurnal->debit;
                $kredit += $jurnal->kredit;
            }
        }
        $pdf = PDF::loadview('pembelian.jurnal-pdf', [
            'jurnals' => $jurnals,
            'debit' => $debit,
            'kredit' => $kredit,
            'transaksi' => $transaksi
        ]);

        return $pdf->download('pembelian.jurnal-pdf.pdf');
        // return view('pembelian.jurnal-pdf', ['jurnals' => $jurnals]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int                      $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
