<?php

namespace App\Http\Controllers\Pembelian;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Pembelian\Retur;
use App\Pembelian\Faktur;
use App\Pembelian\Hutang;
use App\Pembelian\Jurnal;
use App\Stock\Barang;
use App\Stock\Gudang;
use App\Pembelian\Pemasok;
use PDF;

// use App\Pembelian\Akun;

class RetursController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $returs = Retur::all();

        return view('pembelian.pembelian.retur.retur', compact('returs'));
    }

    public function laporan()
    {
        $returs = Retur::all();

        return view('pembelian.pembelian.retur.laporan-retur', compact('returs'));
    }

    public function laporanfilter(Request $date)
    {
        $returs = Retur::select("pbl_returs.*")
            ->whereBetween('tanggal', [$date->start, $date->end])
            ->get();

            return view('pembelian.pembelian.retur.laporan-retur', compact('returs'));
    }

    public function cetaklaporan()
    {
        $returs = Retur::all();

        $pdf = PDF::loadview('pembelian.pembelian.retur.cetak-laporan-retur', compact('returs'));

        return $pdf->download('laporan-retur.pdf');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pembelian.pembelian.retur.returinsert', [
            'pemasoks' => Pemasok::all(),
            'fakturs' => Faktur::all(),
            'barangs' => Barang::all(),
            'gudangs' => Gudang::all(),
            // 'akuns'=> Akun::all(),
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
        $ret = Retur::max('id') + 1;
        $retur = Retur::create([
            'kode_retur' => 'RET-'.$ret,
            'faktur_id' => $request->faktur_id,
            'status' => $request->status,
            'pemasok_id' => $request->pemasok_id,
            'gudang' => 'gudang',
            'tanggal' => $request->tanggal,
            'diskon' => 0,
            'diskon_rp' => $request->diskon,
            'biaya_lain' => 0,
            // 'uang_muka' => $request->uang_muka,
            'total_jenis_barang' => $request->akun_barang,
            'total_harga' => $request->hutang,
        ]);

        // if ($request->status == 'hutang') {
        //     $hut = Hutang::max('id') + 1;
        //     $hutang = $retur->hutang()->create([
        //         'kode_hutang' => 'HUT-'.$hut,
        //         'pemasok_id' => $retur->pemasok_id,
        //         'total_hutang' => $request->hutang,
        //         'sisa' => $request->hutang,
        //         'retur_id' => $retur->id,
        //         'status' => 'hutang',
        //     ]);

        //     $retur->update(['hutang_id' => $hutang->id]);
        // }


        foreach ($request->barang_id as $index => $id) {
            $retur->barangs()->attach($id, [
                'jumlah_barang' => $request->jumlah_barang[$index],
                'harga' => $request->harga[$index],
                'unit' => $request->unit[$index],
                'pajak' => $request->pajak[$index],
                'status_barang' => $request->status_barang[$index],
            ]);
        }

        return redirect('/pembelian/returs');
    }

    public function posting($idnya)
    {
        $retur = Retur::find($idnya);
        $hutang = Hutang::where('faktur_id', $retur->faktur_id)->first();
        // dd($hutang);
        $idhut = $hutang->id;
        Retur::where('id', $retur->id)
                ->update(['status_posting' => 'sudah posting', 'hutang_id' => $idhut]);

                $sisa = $hutang->sisa - $retur->total_harga;
                $hutang->update([
                    'lunas' => $retur->total_harga,
                    'sisa' => $sisa,
                ]);
                if ($sisa == 0){
                    $hutang->update([
                        'status' => 'lunas',
                    ]);
                    $hutang->faktur()->update([
                        'status' => 'lunas',
                    ]);
                }else{
                    $hutang->faktur()->update([
                        'status' => 'dibayar sebagian',
                    ]);
                }

                

        // if ($retur->status == 'hutang') {
            $no = Jurnal::max('id') + 1;
            for ($i = 1; $i < 5; ++$i) {
                $jurnal = Jurnal::create([
                'kode_jurnal' => 'jur'.$no,
                'retur_id' => $retur->id,
                'debit' => 0,
                'kredit' => 0,
            ]);
                if ($i == 1) {
                    $jurnal->update([
                    'kredit' => $retur->total_jenis_barang,
                    'akun_id' => 1, //barang
                ]);
                } 
                // elseif ($i == 2) {
                //     $jurnal->update([
                //     'kredit' => $retur->biaya_lain,
                //     'akun_id' => 3, //biayalain
                // ]);
                // } 
                elseif ($i == 3) {
                    $jurnal->update([
                    'debit' => $retur->total_harga,
                    'akun_id' => 4, //hutang
                ]);
                } 
                elseif ($i == 4) {
                    $jurnal->update([
                    'debit' => $retur->diskon_rp,
                    'akun_id' => 5, //diskon
                ]);
                }
            }
        // } elseif ($retur->status == 'lunas') {
        //     $no = Jurnal::max('id') + 1;
        //     for ($i = 1; $i < 5; ++$i) {
        //         $jurnal = Jurnal::create([
        //             'kode_jurnal' => 'jur'.$no,
        //             'retur_id' => $retur->id,
        //             'debit' => 0,
        //             'kredit' => 0,
        //         ]);
        //         if ($i == 1) {
        //             $jurnal->update([
        //                 'kredit' => $retur->total_jenis_barang - $retur->uang_muka,
        //                 'akun_id' => 1, //barang
        //             ]);
        //         } elseif ($i == 2) {
        //             $jurnal->update([
        //                 'kredit' => $retur->biaya_lain,
        //                 'akun_id' => 3, //biayalain
        //             ]);
        //         } elseif ($i == 3) {
        //             $jurnal->update([
        //                 'debit' => $retur->hutang->total_hutang,
        //                 'akun_id' => 6, //kas
        //             ]);
        //         } elseif ($i == 4) {
        //             $jurnal->update([
        //                 'debit' => $retur->diskon_rp,
        //                 'akun_id' => 5, //diskon
        //             ]);
        //         }
        //     }
        // }

        return redirect('/pembelian/returs');
    }

    /**
     * Display the specified resource.
     *
     * @param int  Retur $retur
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $retur = Retur::find($id);
        $barangs = $retur->barangs;

        return response()
            ->json(['success' => true, 'retur' => $retur, 'barangs' => $barangs]);
    }

    public function show2($id)
    {
        $retur = retur::find($id);
        $faktur = Faktur::find($retur->faktur_id);
        $barangs = $retur->barangs;
        $diskon = $retur->diskon_rp;
        $biaya_lain = $retur->biaya_lain;
        $uang_muka = $retur->uang_muka;
        $total_seluruh = $retur->total_harga;
        $total_harga = [];
        $subtotal = 0;
        foreach ($barangs as $index => $barang) {
            $total_harga[$index] = $barang->pivot->jumlah_barang * $barang->pivot->harga;
            $subtotal += $total_harga[$index];
        }
        // dd($total_harga, $total_seluruh);
        return view('pembelian.pembelian.retur.returdetails', [
            'retur' => $retur,
            'faktur' => $faktur,
            'barangs' => $barangs,
            'diskon' => $diskon,
            'biaya_lain' => $biaya_lain,
            'uang_muka' => $uang_muka,
            'total_harga' => $total_harga,
            'subtotal' => $subtotal,
            'total_seluruh' => $total_seluruh,
        ]);
    }

    public function cetak_pdf(Request $request)
    {
        $retur = retur::find($request->id);
        $faktur = Faktur::find($retur->faktur_id);
        $barangs = $retur->barangs;
        $diskon = $retur->diskon_rp;
        $biaya_lain = $retur->biaya_lain;
        $uang_muka = $retur->uang_muka;
        $total_seluruh = $retur->total_harga;
        $total_harga = [];
        $subtotal = 0;
        foreach ($barangs as $index => $barang) {
            $total_harga[$index] = $barang->pivot->jumlah_barang * $barang->pivot->harga;
            $subtotal += $total_harga[$index];
        }
        $pdf = PDF::loadview('pembelian.pembelian.retur.retur-pdf', [
            'retur' => $retur,
            'faktur' => $faktur,
            'barangs' => $barangs,
            'diskon' => $diskon,
            'biaya_lain' => $biaya_lain,
            'uang_muka' => $uang_muka,
            'total_harga' => $total_harga,
            'subtotal' => $subtotal,
            'total_seluruh' => $total_seluruh,
            ]);

        return $pdf->download('retur.pdf');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int  Retur $retur
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Retur $retur)
    {
        return view('pembelian.pembelian.retur.returedit', [
            'retur' => $retur,
            'pemasoks' => Pemasok::all(),
            'fakturs' => Faktur::all(),
            'barangs' => Barang::all(),
            'gudangs' => Gudang::all(),
            // 'akuns'=> Akun::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int  Retur               $retur
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Retur $retur)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int  Retur $retur
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Retur $retur)
    {
        Retur::destroy($retur->id);

        return redirect('/pembelian/returs');
    }
}
