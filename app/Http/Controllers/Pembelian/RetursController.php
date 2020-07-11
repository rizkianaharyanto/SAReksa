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
use App\Services\Stock\ItemService;
use App\Pembelian\Pemesanan;
use App\Pembelian\Penerimaan;
use Illuminate\Database\Eloquent\Collection;
use PDF;

// use App\Pembelian\Akun;

class RetursController extends Controller
{
    private $itemService;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(ItemService $itemService)
    {
        $this->itemService = $itemService;
    }
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
        $pemasoks = Pemasok::all();
        $returs = retur::all();
        $supplier = null;
        $start = null;
        $end = null;

        return view('pembelian.pembelian.retur.laporan-retur', [
            'returs' => $returs,
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
            $returs = retur::all();
            $supplier = null;
            $start = null;
            $end = null;
        } else {
            $pemasoks = Pemasok::all();
            $supplier = Pemasok::find($date->pemasok_id);
            $start = $date->start;
            $end = $date->end;
            $returs = retur::select("pbl_returs.*")
                ->where('pemasok_id', $date->pemasok_id)
                ->whereBetween('tanggal', [$date->start, $date->end])
                ->get();
        }

        return view('pembelian.pembelian.retur.laporan-retur', [
            'returs' => $returs,
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
            $returs = retur::all();
            $supplier = null;
            $start = null;
            $end = null;
        } else {
            $pemasoks = Pemasok::all();
            $supplier = Pemasok::find($date->pemasok_id);
            $start = $date->start;
            $end = $date->end;
            $returs = retur::select("pbl_returs.*")
                ->where('pemasok_id', $date->pemasok_id)
                ->whereBetween('tanggal', [$date->start, $date->end])
                ->get();
        }

        $pdf = PDF::loadview('pembelian.pembelian.retur.cetak-laporan-retur', [
            'returs' => $returs,
            'pemasoks' => $pemasoks,
            'supplier' => $supplier,
            'start' => $start,
            'end' => $end
        ]);

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
        // dd($request);
        $ret = Retur::max('id') + 1;
        $retur = Retur::create([
            'kode_retur' => 'RET-' . $ret,
            'faktur_id' => $request->faktur_id,
            'status' => $request->status,
            'pemasok_id' => $request->pemasok_id,
            'gudang' => 'gudang',
            'tanggal' => $request->tanggal,
            'diskon' => 0,
            'diskon_rp' => $request->diskon,
            'biaya_lain' => 0,
            'uang_muka' => $request->uang_muka,
            'total_jenis_barang' => $request->akun_barang,
            'total_harga' => $request->hutang,
        ]);

        foreach ($request->barang_id as $index => $id) {
            $retur->barangs()->attach($id, [
                'jumlah_barang' => $request->jumlah_barang[$index],
                'harga' => $request->harga[$index],
                'unit' => $request->unit_barang[$index],
                // 'pajak' => $request->pajak[$index],
                'status_barang' => $request->status_barang[$index],
            ]);
        }

        return redirect('/pembelian/returs');
    }

    public function posting($idnya)
    {
        $retur = Retur::find($idnya);
        // foreach ($retur->barangs as $index => $barang) {
        //     $b = $barang->pivot->jumlah_barang;
        //     //update stock
        //     $this->itemService->getAllStocksQty($barang->id);
        //     $gudangnya=$barang->warehouseStocks;
        //     while ($b > 0) {
        //         foreach ($gudangnya as $gud) {
        //             try {
        //                 // dd($gud);
        //                 $qty = $this->itemService->getStocksByWhouse($barang->id, $gud->id)->kuantitas;
        //                 if ($qty > 0) {
        //                     if ($qty >= $b) {
        //                         $this->itemService->updateStocks($barang->id, $gud->id, $b * -1);
        //                         $b = 0;
        //                     } else {
        //                         $b = $b - $qty;
        //                         $this->itemService->updateStocks($barang->id, $gud->id, $b * -1);
        //                     }
        //                     // dd("berhasil");
        //                 } else {
        //                     $b = $b;
        //                     $this->itemService->updateStocks($barang->id, $gud->id, 0);
        //                 }
        //                 // dd("berhasil");
        //             } catch (\Throwable $th) {
        //                 dd('Gagal');
        //             }
        //         }
        //     }
        // }

        $hutang = Hutang::where('faktur_id', $retur->faktur_id)->first();
        // dd($hutang);
        $idhut = $hutang->id;
        Retur::where('id', $retur->id)
            ->update(['status_posting' => 'sudah posting', 'hutang_id' => $idhut]);

        if ($hutang->sisa > $retur->total_harga) {
            $sisa = $hutang->sisa - $retur->total_harga;
        } else {
            $sisa = $retur->total_harga - $hutang->sisa;
        }
        $hutang->update([
            'lunas' => $retur->total_harga,
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



        // if ($retur->status == 'hutang') {
        $no = Jurnal::max('id') + 1;
        for ($i = 1; $i < 5; ++$i) {
            $jurnal = Jurnal::create([
                'kode_jurnal' => 'jur' . $no,
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
            elseif ($i == 2) {
                $jurnal->update([
                'debit' => $retur->uang_muka,
                'akun_id' => 7, //biayalain
            ]);
            } 
            elseif ($i == 3) {
                $jurnal->update([
                    'debit' => $retur->total_harga,
                    'akun_id' => 4, //hutang
                ]);
            } elseif ($i == 4) {
                $jurnal->update([
                    'debit' => $retur->diskon_rp,
                    'akun_id' => 5, //diskon
                ]);
            }
        }

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
        $pemasok = Pemasok::find($retur->pemasok_id);
        $fakturs = $pemasok->fakturs()->where('status', 'hutang')->get();
        // dd($retur->faktur_id);
        return view('pembelian.pembelian.retur.returedit', [
            'retur' => $retur,
            'pemasoks' => Pemasok::all(),
            'fakturs' => $fakturs,
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
        Retur::where('id', $retur->id)->update([
            'faktur_id' => $request->faktur_id,
            'status' => $request->status,
            'pemasok_id' => $request->pemasok_id,
            'gudang' => 'gudang',
            'tanggal' => $request->tanggal,
            'diskon' => 0,
            'diskon_rp' => $request->diskon,
            'biaya_lain' => 0,
            'uang_muka' => $request->uang_muka,
            'total_jenis_barang' => $request->akun_barang,
            'total_harga' => $request->hutang,
        ]);
        $retur->barangs()->detach();
        foreach ($request->barang_id as $index => $id) {
            $retur->barangs()->attach($id, [
                'jumlah_barang' => $request->jumlah_barang[$index],
                'harga' => $request->harga[$index],
                'unit' => $request->unit_barang[$index],
                // 'pajak' => $request->pajak[$index],
                'status_barang' => $request->status_barang[$index],
            ]);
        }

        return redirect('/pembelian/returs');
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
        $retur->barangs()->detach();
        Retur::destroy($retur->id);

        return redirect('/pembelian/returs');
    }
}
