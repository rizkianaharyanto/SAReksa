<?php

namespace App\Http\Controllers\Pembelian;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Pembelian\Hutang;
use App\Pembelian\Pemasok;
use App\Pembelian\Pembayaran;
use App\Pembelian\Retur;
use Illuminate\Support\Arr;

use PDF;

class HutangsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pemasoks = Pemasok::with('hutangs')->get();
        $totals = [];
        $lunass = [];
        $sisas = [];
        foreach ($pemasoks as $pemasok) {
            $total = $pemasok->hutangs->sum('total_hutang');
            array_push($totals, [
                'total_hutang' => $total
            ]);
            $lunas = $pemasok->hutangs->sum('lunas');
            array_push($lunass, [
                'lunas' => $lunas
            ]);
            $sisa = $pemasok->hutangs->sum('sisa');
            array_push($sisas, [
                'sisa' => $sisa
            ]);
        }
        // dd($totals);
        return view('pembelian.hutang.hutang', [
            'pemasoks' => $pemasoks,
            'totals' => $totals,
            'lunass' => $lunass,
            'sisas' => $sisas,
        ]);
    }

    public function fakturindex()
    {
        $hutangs = Hutang::all();
        $pemasoks = Pemasok::all();
        // dd($hutangs);
        return view('pembelian.hutang.hutangs-faktur', ['hutangs' => $hutangs, 'pemasoks' => $pemasoks]);
    }

    public function filter(Request $date)
    {
        if ($date->start == null) {
            $hutangs = Hutang::all();
            $pemasoks = Pemasok::all();
        } else {
            $hutangs = Hutang::select("pbl_hutangs.*")
                ->whereBetween('tanggal', [$date->start, $date->end])
                ->get();
            $pemasoks = Pemasok::all();
        }
        // dd($hutangs);
        return view('pembelian.hutang.hutangs-faktur', ['hutangs' => $hutangs, 'pemasoks' => $pemasoks]);
    }

    public function laporan()
    {
        $allpemasok = Pemasok::all();
        $hutangs = Hutang::all();
        $supplier = null;
        $start = null;
        $end = null;

        return view('pembelian.hutang.laporan-hutang', [
            'hutangs' => $hutangs,
            'allpemasok' => $allpemasok,
            'supplier' => $supplier,
            'start' => $start,
            'end' => $end
        ]);
    }

    public function laporanfilter(Request $date)
    {
        // dd($date);
        if ($date->pemasok_id == null) {
            if ($date->start == null) {
                $allpemasok = Pemasok::all();
                $hutangs = Hutang::all();
                $supplier = null;
                $start = null;
                $end = null;
            } else {
                $allpemasok = Pemasok::all();
                $hutangs = Hutang::select("pbl_hutangs.*")
                ->whereBetween('tanggal', [$date->start, $date->end])
                ->get();
                $supplier = null;
                $start = $date->start;
                $end = $date->end;
            }
        } else {
            if ($date->start == null) {
                $allpemasok = Pemasok::all();
                $hutangs = Hutang::select("pbl_hutangs.*")
                ->where('pemasok_id', $date->pemasok_id)
                ->get();
                $supplier = Pemasok::find($date->pemasok_id);
                $start = null;
                $end = null;
            } else {
                $allpemasok = Pemasok::all();
                $hutangs = Hutang::select("pbl_hutangs.*")
                    ->where('pemasok_id', $date->pemasok_id)
                    ->whereBetween('tanggal', [$date->start, $date->end])
                    ->get();
                $supplier = Pemasok::find($date->pemasok_id);
                $start = $date->start;
                $end = $date->end;
            }
        }
        return view('pembelian.hutang.laporan-hutang', [
            'hutangs' => $hutangs,
            'allpemasok' => $allpemasok,
            'supplier' => $supplier,
            'start' => $start,
            'end' => $end
        ]);
    }

    public function cetaklaporan(Request $date)
    {
        // dd($date);
        if ($date->pemasok_id == null) {
            if ($date->start == null) {
                $allpemasok = Pemasok::all();
                $hutangs = Hutang::all();
                $supplier = null;
                $start = null;
                $end = null;
            } else {
                $allpemasok = Pemasok::all();
                $hutangs = Hutang::select("pbl_hutangs.*")
                ->whereBetween('tanggal', [$date->start, $date->end])
                ->get();
                $supplier = null;
                $start = $date->start;
                $end = $date->end;
            }
        } else {
            if ($date->start == null) {
                $allpemasok = Pemasok::all();
                $hutangs = Hutang::select("pbl_hutangs.*")
                ->where('pemasok_id', $date->pemasok_id)
                ->get();
                $supplier = Pemasok::find($date->pemasok_id);
                $start = null;
                $end = null;
            } else {
                $allpemasok = Pemasok::all();
                $hutangs = Hutang::select("pbl_hutangs.*")
                    ->where('pemasok_id', $date->pemasok_id)
                    ->whereBetween('tanggal', [$date->start, $date->end])
                    ->get();
                $supplier = Pemasok::find($date->pemasok_id);
                $start = $date->start;
                $end = $date->end;
            }
        }
        $pdf = PDF::loadview('pembelian.hutang.cetak-laporan-hutang', [
            'hutangs' => $hutangs,
            'allpemasok' => $allpemasok,
            'supplier' => $supplier,
            'start' => $start,
            'end' => $end
        ]);


        return $pdf->download('laporan-hutang.pdf');
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $hutangs = Hutang::get()->where('pemasok_id', $id);
        // dd($hutangs);
        return view('pembelian.hutang.hutangdetails', ['hutangs' => $hutangs]);
    }

    public function showpembayaran($id)
    {
        $hutang = Hutang::find($id);
        $retur = $hutang->retur;
        $faktur = $hutang->faktur;
        return response()
            ->json(['success' => true, 'hutang' => $hutang, 'retur' => $retur, 'faktur' => $faktur]);
    }

    public function show2($id)
    {
        $hutang = Hutang::find($id);
        // dd($hutang->pembayarans);
        $pembayarans = $hutang->pembayarans;
        // $total_seluruh = $pembayaran->total;
        // dd($total_harga, $total_seluruh);
        $returs = Retur::where('hutang_id', $hutang->id)->get();
        // dd($returs);
        $lunas = 0;
        foreach ($pembayarans as $pembayaran) {
            $lunas += $pembayaran->pivot->total;
        }
        foreach ($returs as $retur) {
            $lunas += $retur->total_harga;
        }
        $sisa = $hutang->total_hutang - $lunas;
        return view('pembelian.hutang.kartu-hutang', [
            'hutang' => $hutang,
            'pembayarans' => $pembayarans,
            'returs' => $returs,
            'lunas' => $lunas,
            'sisa' => $sisa,
        ]);
    }

    public function cetak_pdf(Request $request)
    {
        $hutang = Hutang::find($request->id);
        // dd($hutang->pembayarans);
        $pembayarans = $hutang->pembayarans;
        // $total_seluruh = $pembayaran->total;
        // dd($total_harga, $total_seluruh);
        $returs = Retur::where('hutang_id', $hutang->id)->get();
        // dd($returs);
        $lunas = 0;
        foreach ($pembayarans as $pembayaran) {
            $lunas += $pembayaran->pivot->total;
        }
        foreach ($returs as $retur) {
            $lunas += $retur->total_harga;
        }
        $sisa = $hutang->total_hutang - $lunas;
        $pdf = PDF::loadview('pembelian.hutang.kartu-hutang-pdf', [
            'hutang' => $hutang,
            'pembayarans' => $pembayarans,
            'returs' => $returs,
            'lunas' => $lunas,
            'sisa' => $sisa,
        ]);


        return $pdf->download('kartu-hutang.pdf');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
