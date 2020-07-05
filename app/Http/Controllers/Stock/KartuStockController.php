<?php

namespace App\Http\Controllers\Stock;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Stock\Barang;
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
        $all = new Collection([]);
        foreach ($barangs as $barang) {
            $qty_masuk = 0;
            $nilai_masuk = 0;
            $qty_keluar = 0;
            $nilai_keluar = 0;
            $sisa = 0;
            $stockOpname = $barang->stockOpname;
            $stockTransfer = $barang->stockTransfer;
            $stockPenyesuaian = $barang->penyesuaianStok;
            $details = new Collection([$stockOpname, $stockTransfer, $stockPenyesuaian]);

            foreach ($stockOpname as $index => $op) {
                $selisih = $op->pivot->jumlah_fisik - $op->pivot->jumlah_tercatat;
                if ($selisih >= 0) {
                    $qty_masuk += $selisih;
                    $nilai_masuk += $op->details[0]->nilai_barang;
                } else {
                    $selisih = $selisih * -1;
                    $qty_keluar += $selisih;
                    $nilai_keluar += $op->details[0]->nilai_barang;
                }
                $sisa += $selisih;
            }
            foreach ($stockPenyesuaian as $index => $pny) {
                $selisih = $pny->pivot->quantity_diff;
                if ($selisih >= 0) {
                    $qty_masuk += $selisih;
                    $nilai_masuk += $pny->details[0]->nilai_barang;
                } else {
                    $selisih = $selisih * -1;
                    $qty_keluar += $selisih;
                    $nilai_keluar += $pny->details[0]->nilai_barang;
                }
                $sisa += $selisih;
            }
            foreach ($stockTransfer as $index => $trf) {
                $selisih = $trf->pivot->kuantitas;
                $qty_masuk += $selisih;
                $qty_keluar += $selisih;
                $sisaan = 0;
                $nilai_masuk += $trf->items[0]->nilai_barang;
                $nilai_keluar += $trf->items[0]->nilai_barang;
            }
            $alldetails = $all->push([
                'kartu' => $details,
                'qty_masuk' => $qty_masuk,
                'nilai_masuk' => $nilai_masuk,
                'qty_keluar' => $qty_keluar,
                'nilai_keluar' => $nilai_keluar,
                'sisa' => $sisa,
            ]);
        }
        $barang = null;
        $start = null;
        $end = null;
        // dd($alldetails);
        return view('stock.reports.kartu-stock', ['barangs' => $barangs, 'barang' => $barang, 'start' => $start, 'end' => $end, 'alldetails' => $alldetails]);
    }

    public function filter(Request $request)
    {
        if ($request->barang == null) {
            return $this->index();
        } else {
            $start = $request->start;
            $end = $request->end;
            $barangs = Barang::all();
            $barang = Barang::with([
                'pemasok'
            ])->find($request->barang);
            $all = new Collection([]);
            $qty_masuk = 0;
            $nilai_masuk = 0;
            $qty_keluar = 0;
            $nilai_keluar = 0;
            $sisa = 0;
            $stockOpname = $barang->stockOpname->whereBetween('created_at', [$request->start, $request->end]);
            $stockTransfer = $barang->stockTransfer->whereBetween('created_at', [$request->start, $request->end]);
            $stockPenyesuaian = $barang->penyesuaianStok->whereBetween('created_at', [$request->start, $request->end]);
            $details = new Collection([$stockOpname, $stockTransfer, $stockPenyesuaian]);

            foreach ($stockOpname as $index => $op) {
                $selisih = $op->pivot->jumlah_fisik - $op->pivot->jumlah_tercatat;
                if ($selisih >= 0) {
                    $qty_masuk += $selisih;
                    $nilai_masuk += $op->details[0]->nilai_barang;
                } else {
                    $selisih = $selisih * -1;
                    $qty_keluar += $selisih;
                    $nilai_keluar += $op->details[0]->nilai_barang;
                }
                $sisa += $selisih;
            }
            foreach ($stockPenyesuaian as $index => $pny) {
                $selisih = $pny->pivot->quantity_diff;
                if ($selisih >= 0) {
                    $qty_masuk += $selisih;
                    $nilai_masuk += $pny->details[0]->nilai_barang;
                } else {
                    $selisih = $selisih * -1;
                    $qty_keluar += $selisih;
                    $nilai_keluar += $pny->details[0]->nilai_barang;
                }
                $sisa += $selisih;
            }
            foreach ($stockTransfer as $index => $trf) {
                $selisih = $trf->pivot->kuantitas;
                $qty_masuk += $selisih;
                $qty_keluar += $selisih;
                $sisaan = 0;
                $nilai_masuk += $trf->items[0]->nilai_barang;
                $nilai_keluar += $trf->items[0]->nilai_barang;
            }
            $alldetails = $all->push([
                'kartu' => $details,
                'qty_masuk' => $qty_masuk,
                'nilai_masuk' => $nilai_masuk,
                'qty_keluar' => $qty_keluar,
                'nilai_keluar' => $nilai_keluar,
                'sisa' => $sisa,
            ]);
        }
        // dd($alldetails);

        return view('stock.reports.kartu-stock', ['barangs' => $barangs, 'barang' => $barang, 'start' => $start, 'end' => $end, 'alldetails' => $alldetails]);
    }

    public function export(Request $request)
    {
        if ($request->id == null) {
            return $this->index();
        } else {
            $barangs = Barang::all();
            $barang = Barang::with([
                'pemasok'
            ])->find($request->id);
            $all = new Collection([]);
            $qty_masuk = 0;
            $nilai_masuk = 0;
            $qty_keluar = 0;
            $nilai_keluar = 0;
            $sisa = 0;
            $stockOpname = $barang->stockOpname->whereBetween('created_at', [$request->start, $request->end]);
            $stockTransfer = $barang->stockTransfer->whereBetween('created_at', [$request->start, $request->end]);
            $stockPenyesuaian = $barang->penyesuaianStok->whereBetween('created_at', [$request->start, $request->end]);
            $details = new Collection([$stockOpname, $stockTransfer, $stockPenyesuaian]);

            foreach ($stockOpname as $index => $op) {
                $selisih = $op->pivot->jumlah_fisik - $op->pivot->jumlah_tercatat;
                if ($selisih >= 0) {
                    $qty_masuk += $selisih;
                    $nilai_masuk += $op->details[0]->nilai_barang;
                } else {
                    $selisih = $selisih * -1;
                    $qty_keluar += $selisih;
                    $nilai_keluar += $op->details[0]->nilai_barang;
                }
                $sisa += $selisih;
            }
            foreach ($stockPenyesuaian as $index => $pny) {
                $selisih = $pny->pivot->quantity_diff;
                if ($selisih >= 0) {
                    $qty_masuk += $selisih;
                    $nilai_masuk += $pny->details[0]->nilai_barang;
                } else {
                    $selisih = $selisih * -1;
                    $qty_keluar += $selisih;
                    $nilai_keluar += $pny->details[0]->nilai_barang;
                }
                $sisa += $selisih;
            }
            foreach ($stockTransfer as $index => $trf) {
                $selisih = $trf->pivot->kuantitas;
                $qty_masuk += $selisih;
                $qty_keluar += $selisih;
                $sisaan = 0;
                $nilai_masuk += $trf->items[0]->nilai_barang;
                $nilai_keluar += $trf->items[0]->nilai_barang;
            }
            $alldetails = $all->push([
                'kartu' => $details,
                'qty_masuk' => $qty_masuk,
                'nilai_masuk' => $nilai_masuk,
                'qty_keluar' => $qty_keluar,
                'nilai_keluar' => $nilai_keluar,
                'sisa' => $sisa,
            ]);
        }

        // return view('stock.reports.export-kartu-stock', ['barangs' => $barangs, 'barang' => $barang, 'alldetails' => $alldetails]);
        
        $pdf = PDF::loadview('stock.reports.export-kartu-stock', ['barangs' => $barangs, 'barang' => $barang, 'alldetails' => $alldetails]);
        
        return $pdf->download('kartu-stock.pdf');
    }
}
