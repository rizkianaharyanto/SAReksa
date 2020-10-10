<?php

namespace App\Http\Controllers\Stock;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Stock\Barang;
use App\Stock\Ledger;
use App\Stock\StokOpname;
use Illuminate\Database\Eloquent\Collection;

use PDF;

class KartuStockController extends Controller
{
    private $service;
    public function __construct()
    {
    }

    public function index()
    {
        $barangs = Barang::all();
        $ledgers = Ledger::all()->groupBy('barang_id');
        $barang = null;
        $start = null;
        $end = null;
        $qty_masuk = 0;
        $nilai_masuk = 0;
        $qty_keluar = 0;
        $nilai_keluar = 0;
        $sisa = 0;
        $total = collect([]);
        $totalsemua = collect([]);

        foreach ($ledgers as $ledger) {
            $qty_masuk = 0;
            $nilai_masuk = 0;
            $qty_keluar = 0;
            $nilai_keluar = 0;
            $sisa = 0;
            foreach ($ledger as $index) {
                $qty_masuk += $index->qty_masuk;
                $nilai_masuk += $index->nilai_masuk;
                $qty_keluar += $index->qty_keluar;
                $nilai_keluar += $index->nilai_keluar;
                $sisa += $index->sisa;
            }
            $totalsemua = $total->push([
                'qty_masuk_total' => $qty_masuk,
                'nilai_masuk_total' => $nilai_masuk,
                'qty_keluar_total' => $qty_keluar,
                'nilai_keluar_total' => $nilai_keluar,
                'sisa_total' => $sisa,
            ]);
        }
        // dd($totalsemua);
        return view('stock.reports.kartu-stock', [
            'barangs' => $barangs,
            'ledgers' => $ledgers,
            'barang' => $barang,
            'start' => $start,
            'end' => $end,
            'total' => $totalsemua,
        ]);
    }

    public function filter(Request $request)
    {
        if ($request->barang == null) {
            return $this->index();
        } else {
            $barangs = Barang::all();
            $ledgers = Ledger::where('barang_id', $request->barang)
                ->whereBetween('created_at', [$request->start, $request->end])
                ->get();
            $barang = Barang::find($request->barang);
            // dd($ledgers);
            $start = $request->start;
            $end = $request->end;
            $qty_masuk = 0;
            $nilai_masuk = 0;
            $qty_keluar = 0;
            $nilai_keluar = 0;
            $sisa = 0;
            $total = collect([]);
            $totalsemua = collect([]);

            foreach ($ledgers as $ledger) {
                $qty_masuk += $ledger->qty_masuk;
                $nilai_masuk += $ledger->nilai_masuk;
                $qty_keluar += $ledger->qty_keluar;
                $nilai_keluar += $ledger->nilai_keluar;
                $sisa += $ledger->sisa;
            }
            $totalsemua = $total->push([
                'qty_masuk_total' => $qty_masuk,
                'nilai_masuk_total' => $nilai_masuk,
                'qty_keluar_total' => $qty_keluar,
                'nilai_keluar_total' => $nilai_keluar,
                'sisa_total' => $sisa,
            ]);
            // dd($totalsemua);
            return view('stock.reports.kartu-stock', [
                'barangs' => $barangs,
                'ledgers' => $ledgers,
                'barang' => $barang,
                'start' => $start,
                'end' => $end,
                'total' => $totalsemua,
            ]);
        }
    }

    public function export(Request $request)
    {
        // dd($request);
        if ($request->id == null) {
            $barangs = Barang::all();
            $ledgers = Ledger::all()->groupBy('barang_id');
            $barang = null;
            $start = null;
            $end = null;
            $qty_masuk = 0;
            $nilai_masuk = 0;
            $qty_keluar = 0;
            $nilai_keluar = 0;
            $sisa = 0;
            $total = collect([]);
            $totalsemua = collect([]);

            foreach ($ledgers as $ledger) {
                $qty_masuk = 0;
                $nilai_masuk = 0;
                $qty_keluar = 0;
                $nilai_keluar = 0;
                $sisa = 0;
                foreach ($ledger as $index) {
                    $qty_masuk += $index->qty_masuk;
                    $nilai_masuk += $index->nilai_masuk;
                    $qty_keluar += $index->qty_keluar;
                    $nilai_keluar += $index->nilai_keluar;
                    $sisa += $index->sisa;
                }
                $totalsemua = $total->push([
                    'qty_masuk_total' => $qty_masuk,
                    'nilai_masuk_total' => $nilai_masuk,
                    'qty_keluar_total' => $qty_keluar,
                    'nilai_keluar_total' => $nilai_keluar,
                    'sisa_total' => $sisa,
                ]);
            }
            $pdf = PDF::loadview('stock.reports.export-kartu-stock', [
                'barangs' => $barangs,
                'ledgers' => $ledgers,
                'barang' => $barang,
                'start' => $start,
                'end' => $end,
                'total' => $totalsemua,
            ]);

            return $pdf->download('kartu-stock.pdf');
        } else {
            $barangs = Barang::all();
            $ledgers = Ledger::where('barang_id', $request->id)
                ->whereBetween('created_at', [$request->start, $request->end])
                ->get();
            $barang = Barang::find($request->id);
            // dd($ledgers);
            $start = $request->start;
            $end = $request->end;
            $qty_masuk = 0;
            $nilai_masuk = 0;
            $qty_keluar = 0;
            $nilai_keluar = 0;
            $sisa = 0;
            $total = collect([]);
            $totalsemua = collect([]);

            foreach ($ledgers as $ledger) {
                $qty_masuk += $ledger->qty_masuk;
                $nilai_masuk += $ledger->nilai_masuk;
                $qty_keluar += $ledger->qty_keluar;
                $nilai_keluar += $ledger->nilai_keluar;
                $sisa += $ledger->sisa;
            }
            $totalsemua = $total->push([
                'qty_masuk_total' => $qty_masuk,
                'nilai_masuk_total' => $nilai_masuk,
                'qty_keluar_total' => $qty_keluar,
                'nilai_keluar_total' => $nilai_keluar,
                'sisa_total' => $sisa,
            ]);
            $pdf = PDF::loadview('stock.reports.export-kartu-stock', [
                'barangs' => $barangs,
                'ledgers' => $ledgers,
                'barang' => $barang,
                'start' => $start,
                'end' => $end,
                'total' => $totalsemua,
            ]);

            return $pdf->download('kartu-stock.pdf');
        }

        // return view('stock.reports.export-kartu-stock', ['barangs' => $barangs, 'barang' => $barang, 'alldetails' => $alldetails]);


    }
}
