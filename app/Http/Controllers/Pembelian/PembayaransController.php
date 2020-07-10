<?php

namespace App\Http\Controllers\Pembelian;

use App\Http\Controllers\Controller;
use App\Pembelian\Hutang;
use App\Pembelian\Jurnal;
use App\Pembelian\Pemasok;
use Illuminate\Http\Request;
use App\Pembelian\Pembayaran;
use App\Penjualan\PembayaranDetail;
use PDF;

class PembayaransController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pembayarans = Pembayaran::all();

        return view('pembelian.hutang.pembayaran', compact('pembayarans'));
    }

    public function laporan()
    {
        $pemasoks = Pemasok::all();
        $pembayarans = Pembayaran::all();
        $supplier = null;
        $start = null;
        $end = null;

        return view('pembelian.hutang.laporan-pembayaran', [
            'pembayarans' => $pembayarans,
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
            $pembayarans = Pembayaran::all();
            $supplier = null;
            $start = null;
            $end = null;
        } else {
            $pemasoks = Pemasok::all();
            $supplier = Pemasok::find($date->pemasok_id);
            $start = $date->start;
            $end = $date->end;
            $pembayarans = Pembayaran::select("pbl_pembayarans.*")
                ->where('pemasok_id', $date->pemasok_id)
                ->whereBetween('tanggal', [$date->start, $date->end])
                ->get();
        }
        return view('pembelian.hutang.laporan-pembayaran', [
            'pembayarans' => $pembayarans,
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
            $pembayarans = Pembayaran::all();
            $supplier = null;
            $start = null;
            $end = null;
        } else {
            $pemasoks = Pemasok::all();
            $supplier = Pemasok::find($date->pemasok_id);
            $start = $date->start;
            $end = $date->end;
            $pembayarans = Pembayaran::select("pbl_pembayarans.*")
                ->where('pemasok_id', $date->pemasok_id)
                ->whereBetween('tanggal', [$date->start, $date->end])
                ->get();
        }
        $pdf = PDF::loadview('pembelian.hutang.cetak-laporan-pembayaran', [
            'pembayarans' => $pembayarans,
            'pemasoks' => $pemasoks,
            'supplier' => $supplier,
            'start' => $start,
            'end' => $end
        ]);

        return $pdf->download('laporan-pembayaran.pdf');
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pemasoks = Pemasok::all();
        $hutangs = Hutang::all();

        return view('pembelian.hutang.pembayaraninsert', [
            'pemasoks' => $pemasoks,
            'hutangs' => $hutangs,
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
        // dd($request);
        $byr = Pembayaran::max('id') + 1;
        $pembayaran = Pembayaran::create([
            'kode_pembayaran' => 'BYR-' . $byr,
            'pemasok_id' => $request->pemasok_id,
            'tanggal' => $request->tanggal,
            'total' => $request->total_harga,
        ]);

        $no = Jurnal::max('id') + 1;
        for ($i = 1; $i < 3; ++$i) {
            $jurnal = Jurnal::create([
                'kode_jurnal' => 'jur' . $no,
                'pembayaran_id' => $pembayaran->id,
                'debit' => 0,
                'kredit' => 0,
            ]);
            if ($i == 1) {
                $jurnal->update([
                    'debit' => $request->total_harga,
                    'akun_id' => 4, //hutang
                ]);
            } elseif ($i == 2) {
                $jurnal->update([
                    'kredit' => $request->total_harga,
                    'akun_id' => 6, //kas
                ]);
            }
        }

        foreach ($request->hutang_id as $index => $id) {
            $hutang = Hutang::find($id);
            $lunas = $hutang->lunas;
            $lunas += $request->total[$index];
            $sisa = $hutang->sisa - $request->total[$index];
            $hutang->update([
                'lunas' => $lunas,
                'sisa' => $sisa,
            ]);
            if ($sisa == 0) {
                $hutang->update([
                    'status' => 'lunas',
                ]);
                $hutang->faktur()->update([
                    'status' => 'lunas',
                ]);
            } else {
                $hutang->faktur()->update([
                    'status' => 'dibayar sebagian',
                ]);
            }
        }

        foreach ($request->hutang_id as $index => $id) {
            $pembayaran->hutangs()->attach($id, [
                'total' => $request->total[$index],
            ]);
        }

        return redirect('/pembelian/pembayarans');
    }

    public function posting($idnya)
    {
        Pembayaran::find($idnya)->update(['status' => 'sudah posting']);
        return redirect('/pembelian/pembayarans');
    }

    /**
     * Display the specified resource.
     *
     * @param int  Pembayaran $pembayaran
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    public function show2($id)
    {
        $pembayaran = Pembayaran::find($id);
        // dd($pembayaran->hutangs);
        $hutangs = $pembayaran->hutangs;
        $total_seluruh = $pembayaran->total;
        // dd($total_harga, $total_seluruh);
        return view('pembelian.hutang.pembayarandetails', [
            'pembayaran' => $pembayaran,
            'hutangs' => $hutangs,
            'total_seluruh' => $total_seluruh,
        ]);
    }

    public function cetak_pdf(Request $request)
    {
        $pembayaran = Pembayaran::find($request->id);
        $hutangs = $pembayaran->hutangs;
        $total_seluruh = $pembayaran->total;
        $pdf = PDF::loadview('pembelian.hutang.pembayaran-pdf', [
            'pembayaran' => $pembayaran,
            'hutangs' => $hutangs,
            'total_seluruh' => $total_seluruh,
        ]);


        return $pdf->download('pembayaran.pdf');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int  Pembayaran $pembayaran
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Pembayaran $pembayaran)
    {
        $hutangs = $pembayaran->hutangs;
        return view('pembelian.hutang.pembayaranedit', [
            'pembayaran' => $pembayaran,
            'pemasoks' => Pemasok::all(),
            'hutangs' => $hutangs,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int  Pembayaran          $pembayaran
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pembayaran $pembayaran)
    {
        // dd($request);
        $jurnals = Jurnal::where('pembayaran_id', $pembayaran->id)->get('id');
        foreach ($jurnals as $jurnal) {
            Jurnal::destroy($jurnal->id);
        }

        foreach ($pembayaran->hutangs as $index => $id) {
            $hutang = Hutang::find($id->id);
            // dd($id->pivot->total);
            $lunas = $hutang->lunas - $id->pivot->total;
            $sisa = $hutang->sisa;
            $sisa += $id->pivot->total;
            $hutang->update([
                'sisa' => $sisa,
                'lunas' => $lunas,
            ]);
            // dd($hutang->total_hutang);
            if ($hutang->sisa == 0) {
                $hutang->update([
                    'status' => 'lunas',
                ]);
                $hutang->faktur()->update([
                    'status' => 'lunas',
                ]);
            } else if ($hutang->sisa == $hutang->total_hutang) {
                $hutang->faktur()->update([
                    'status' => 'hutang',
                ]);
                $hutang->update([
                    'status' => 'hutang',
                ]);
            } else {
                $hutang->update([
                    'status' => 'hutang',
                ]);
                $hutang->faktur()->update([
                    'status' => 'dibayar sebagian',
                ]);
            }
        }

        Pembayaran::find($pembayaran->id)->update([
            'pemasok_id' => $request->pemasok_id,
            'tanggal' => $request->tanggal,
            'total' => $request->total_harga,
        ]);


        $no = Jurnal::max('id') + 1;
        for ($i = 1; $i < 3; ++$i) {
            $jurnal = Jurnal::create([
                'kode_jurnal' => 'jur' . $no,
                'pembayaran_id' => $pembayaran->id,
                'debit' => 0,
                'kredit' => 0,
            ]);
            if ($i == 1) {
                $jurnal->update([
                    'debit' => $request->total_harga,
                    'akun_id' => 4, //hutang
                ]);
            } elseif ($i == 2) {
                $jurnal->update([
                    'kredit' => $request->total_harga,
                    'akun_id' => 6, //kas
                ]);
            }
        }

        foreach ($request->hutang_id as $index => $id) {
            $hutang = Hutang::find($id);
            $lunas = $hutang->lunas;
            $lunas += $request->total[$index];
            $sisa = $hutang->sisa - $request->total[$index];
            $hutang->update([
                'lunas' => $lunas,
                'sisa' => $sisa,
            ]);
            // dd($hutang->sisa);
            if ($hutang->sisa == 0) {
                $hutang->update([
                    'status' => 'lunas',
                ]);
                $hutang->faktur()->update([
                    'status' => 'lunas',
                ]);
            } else if ($hutang->sisa == $hutang->total_hutang) {
                $hutang->faktur()->update([
                    'status' => 'hutang',
                ]);
                $hutang->update([
                    'status' => 'hutang',
                ]);
            } else {
                $hutang->update([
                    'status' => 'hutang',
                ]);
                $hutang->faktur()->update([
                    'status' => 'dibayar sebagian',
                ]);
            }
        }
        $pembayaran->hutangs()->detach();
        foreach ($request->hutang_id as $index => $id) {
            $pembayaran->hutangs()->attach($id, [
                'total' => $request->total[$index],
            ]);
        }

        return redirect('/pembelian/pembayarans');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int  Pembayaran $pembayaran
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pembayaran $pembayaran)
    {
        $jurnals = Jurnal::where('pembayaran_id', $pembayaran->id)->get('id');
        foreach ($jurnals as $jurnal) {
            Jurnal::destroy($jurnal->id);
        }

        foreach ($pembayaran->hutangs as $index => $id) {
            $hutang = Hutang::find($id->id);
            // dd($id->pivot->total);
            $lunas = $hutang->lunas - $id->pivot->total;
            $sisa = $hutang->sisa;
            $sisa += $id->pivot->total;
            $hutang->update([
                'sisa' => $sisa,
                'lunas' => $lunas,
            ]);
            // dd($hutang->total_hutang);
            if ($hutang->sisa == 0) {
                $hutang->update([
                    'status' => 'lunas',
                ]);
                $hutang->faktur()->update([
                    'status' => 'lunas',
                ]);
            } else if ($hutang->sisa == $hutang->total_hutang) {
                $hutang->faktur()->update([
                    'status' => 'hutang',
                ]);
                $hutang->update([
                    'status' => 'hutang',
                ]);
            } else {
                $hutang->update([
                    'status' => 'hutang',
                ]);
                $hutang->faktur()->update([
                    'status' => 'dibayar sebagian',
                ]);
            }
        }
        $pembayaran->hutangs()->detach();
        Pembayaran::destroy($pembayaran->id);

        return redirect('/pembelian/pembayarans');
    }
}
