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
use App\Services\Stock\ItemService;
use App\Stock\HargaRetailHistory;
use PDF;

class PenerimaansController extends Controller
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

    public function index()
    {
        $penerimaans = Penerimaan::all();

        return view('pembelian.pembelian.penerimaan.penerimaan', compact('penerimaans'));
    }


    public function stokmasuk()
    {
        $penerimaans = Penerimaan::all();
        $count = collect([]);
        foreach ($penerimaans as $penerimaan) {
            $satu = $penerimaan->barangs->count();
            $count->push($satu);
        }
        // dd($count);

        return view('stock.transactions.stock-masuk.index', [
            'penerimaans' => $penerimaans,
            'barangs' => $count,
        ]);
    }
    public function stokmasukdetail($id)
    {
        $penerimaan = penerimaan::find($id);
        $gudang = Gudang::find($penerimaan->gudang);
        $barangs = $penerimaan->barangs;
        $diskon = $penerimaan->diskon_rp;
        $biaya_lain = $penerimaan->biaya_lain;
        $total_seluruh = $penerimaan->total_harga;
        $total_harga = [];
        $subtotal = 0;
        foreach ($barangs as $index => $barang) {
            $total_harga[$index] = $barang->pivot->jumlah_barang * $barang->pivot->harga;
            $subtotal += $total_harga[$index];
        }
        // dd($total_harga, $total_seluruh);
        return view('stock.transactions.stock-masuk.details', [
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




    public function laporan()
    {
        $pemasoks = Pemasok::all();
        $penerimaans = penerimaan::all();
        $supplier = null;
        $start = null;
        $end = null;

        return view('pembelian.pembelian.penerimaan.laporan-penerimaan', [
            'penerimaans' => $penerimaans,
            'pemasoks' => $pemasoks,
            'supplier' => $supplier,
            'start' => $start,
            'end' => $end
        ]);
    }

    public function laporanfilter(Request $date)
    {
        if ($date->pemasok_id == null) {
            if ($date->start == null) {
                $pemasoks = Pemasok::all();
                $penerimaans = penerimaan::all();
                $supplier = null;
                $start = null;
                $end = null;
            } else {
                $pemasoks = Pemasok::all();
                $penerimaans = penerimaan::select("pbl_penerimaans.*")
                    ->whereBetween('tanggal', [$date->start, $date->end])
                    ->get();
                $supplier = null;
                $start = $date->start;
                $end = $date->end;
            }
        } else {
            if ($date->start == null) {
                $pemasoks = Pemasok::all();
                $supplier = Pemasok::find($date->pemasok_id);
                $start = null;
                $end = null;
                $penerimaans = penerimaan::select("pbl_penerimaans.*")
                    ->where('pemasok_id', $date->pemasok_id)
                    ->get();
            } else {
                $pemasoks = Pemasok::all();
                $supplier = Pemasok::find($date->pemasok_id);
                $start = $date->start;
                $end = $date->end;
                $penerimaans = penerimaan::select("pbl_penerimaans.*")
                    ->where('pemasok_id', $date->pemasok_id)
                    ->whereBetween('tanggal', [$date->start, $date->end])
                    ->get();
            }
        }

        return view('pembelian.pembelian.penerimaan.laporan-penerimaan', [
            'penerimaans' => $penerimaans,
            'pemasoks' => $pemasoks,
            'supplier' => $supplier,
            'start' => $start,
            'end' => $end
        ]);
    }

    public function cetaklaporan(Request $date)
    {
        if ($date->pemasok_id == null) {
            if ($date->start == null) {
                $pemasoks = Pemasok::all();
                $penerimaans = penerimaan::all();
                $supplier = null;
                $start = null;
                $end = null;
            } else {
                $pemasoks = Pemasok::all();
                $penerimaans = penerimaan::select("pbl_penerimaans.*")
                    ->whereBetween('tanggal', [$date->start, $date->end])
                    ->get();
                $supplier = null;
                $start = $date->start;
                $end = $date->end;
            }
        } else {
            if ($date->start == null) {
                $pemasoks = Pemasok::all();
                $supplier = Pemasok::find($date->pemasok_id);
                $start = null;
                $end = null;
                $penerimaans = penerimaan::select("pbl_penerimaans.*")
                    ->where('pemasok_id', $date->pemasok_id)
                    ->get();
            } else {
                $pemasoks = Pemasok::all();
                $supplier = Pemasok::find($date->pemasok_id);
                $start = $date->start;
                $end = $date->end;
                $penerimaans = penerimaan::select("pbl_penerimaans.*")
                    ->where('pemasok_id', $date->pemasok_id)
                    ->whereBetween('tanggal', [$date->start, $date->end])
                    ->get();
            }
        }

        $pdf = PDF::loadview('pembelian.pembelian.penerimaan.cetak-laporan-penerimaan', [
            'penerimaans' => $penerimaans,
            'pemasoks' => $pemasoks,
            'supplier' => $supplier,
            'start' => $start,
            'end' => $end
        ]);

        return $pdf->download('laporan-penerimaan.pdf');
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
            'kode_penerimaan' => 'PNM-' . $pnm,
            'pemesanan_id' => $request->pemesanan_id,
            // 'status' => $request->status,
            'pemasok_id' => $request->pemasok_id,
            'gudang' => $request->gudang,
            'tanggal' => $request->tanggal,
            'diskon' => $request->diskon,
            'diskon_rp' => $request->disk,
            'biaya_lain' => $request->biaya_lain,
            'total_jenis_barang' => $request->akun_barang,
            'total_harga' => $request->total_harga_keseluruhan,
            'akun_barang' => $request->akun_barang,
        ]);

        $pemesanan = $penerimaan->pemesanan;
        foreach ($request->barang_id as $index => $id) {
            $penerimaan->barangs()->attach($id, [
                'jumlah_barang' => $request->jumlah_barang[$index],
                'harga' => $request->harga[$index],
                'unit' => $request->unit_barang[$index],
                // 'pajak' => $request->pajak[$index],
            ]);
        }

        return redirect('/pembelian/penerimaans');
    }

    public function posting($idnya)
    {
        $penerimaan = Penerimaan::find($idnya);
        Penerimaan::where('id', $penerimaan->id)
            ->update(['status' => 'konfirmasi']);

        //posting
        $no = Jurnal::max('id') + 1;
        for ($i = 1; $i < 3; ++$i) {
            $jurnal = Jurnal::create([
                'kode_jurnal' => 'jur' . $no,
                'penerimaan_id' => $penerimaan->id,
                'tanggal' => $penerimaan->tanggal,
                'debit' => 0,
                'kredit' => 0,
            ]);
            if ($i == 1) {
                $jurnal->update([
                    'debit' => $penerimaan->total_jenis_barang,
                    'akun_id' => 1, //barang
                ]);
            } elseif ($i == 2) {
                $jurnal->update([
                    'kredit' => $penerimaan->total_jenis_barang,
                    'akun_id' => 2, //barang belum ditagih
                ]);
            }
        }

        $pemesanan = $penerimaan->pemesanan;
        foreach ($penerimaan->barangs as $index => $barang) {
            $a = $pemesanan->barangs()->where('barang_id', $barang->id)->first()->pivot->barang_belum_diterima;
            $b = $barang->pivot->jumlah_barang;
            $belum_diterima = $a - $b;

            //update stock
            // dd($gud);
            $qty = $this->itemService->getStocksQtyByWhouse($penerimaan->gudang, $barang->id);
            try {
                if ($qty) {
                    // dd($qty);
                    $qty += $b;
                } else {
                    $qty = $b;
                }
                $this->itemService->updateStocks($barang->id, $penerimaan->gudang, $qty);
                // dd("berhasil");
            } catch (\Throwable $th) {
                dd('Gagal');
            }

            //update harga barang
            try {
                HargaRetailHistory::create([
                    'item_id' => $barang->id,
                    'harga_retail' => $barang->pivot->harga,
                ]);
            } catch (\Throwable $th) {
                throw $th;
            }
            // dd($a, $b, $belum_diterima);
            $pemesanan->barangs()->where('barang_id', $barang->id)->update(array('barang_belum_diterima' => $belum_diterima));
            if ($belum_diterima == 0) {
                $pemesanan->barangs()->where('barang_id', $barang->id)->update(array('status_barang' => 'diterima'));
            } else {
                $pemesanan->barangs()->where('barang_id', $barang->id)->update(array('status_barang' => 'belum diterima'));
            }
        }

        return view('pembelian.pembelian.penerimaan.konfirmasi', ['id' => $idnya]);
    }

    public function ubahpsn($idnya)
    {
        $penerimaan = Penerimaan::find($idnya);
        Penerimaan::where('id', $penerimaan->id)
            ->update(['status' => 'sudah posting']);
        $pemesanan = $penerimaan->pemesanan;
        $status = $pemesanan->barangs()->where('status_barang', 'belum diterima')->first();
        // dd($status);
        if ($status) {
            $pemesanan->update(array('status' => 'diterima sebagian'));
        } else {
            $pemesanan->update(array('status' => 'diterima'));
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
        $total_seluruh_pnm = $penerimaan->total_harga;
        $total_harga_pnm = [];
        $subtotal_pnm = 0;
        foreach ($barangs as $index => $barang) {
            $total_harga_pnm[$index] = $barang->pivot->jumlah_barang * $barang->pivot->harga;
            $subtotal_pnm += $total_harga_pnm[$index];
        }
        // dd($barangs);
        return response()
            ->json([
                'success' => true, 'penerimaan' => $penerimaan, 'barangs' => $barangs,
                'total_seluruh_pnm' => $total_seluruh_pnm,
                'total_harga_pnm' => $total_harga_pnm,
                'subtotal_pnm' => $subtotal_pnm,
            ]);
    }

    public function show2($id)
    {
        $penerimaan = penerimaan::find($id);
        $gudang = Gudang::find($penerimaan->gudang);
        $barangs = $penerimaan->barangs;
        $diskon = $penerimaan->diskon_rp;
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
        $diskon = $penerimaan->diskon_rp;
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
        $pemasok = Pemasok::find($penerimaan->pemasok_id);
        $pnmpemesanans = $pemasok->pemesanans()->whereNotIn('status', ['diterima', 'selesai'])->get();
        return view('pembelian.pembelian.penerimaan.penerimaanedit', [
            'penerimaan' => $penerimaan,
            'pemesanans' => $pnmpemesanans,
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
        Penerimaan::find($penerimaan->id)
            ->update([
                'pemesanan_id' => $request->pemesanan_id,
                'pemasok_id' => $request->pemasok_id,
                'gudang' => $request->gudang,
                'tanggal' => $request->tanggal,
                'diskon' => $request->diskon,
                'diskon_rp' => $request->disk,
                'biaya_lain' => $request->biaya_lain,
                'total_jenis_barang' => $request->akun_barang,
                'total_harga' => $request->total_harga_keseluruhan,
                'akun_barang' => $request->akun_barang,
            ]);
        // dd($penerimaan);
        $penerimaan->barangs()->detach();
        $pemesanan = $penerimaan->pemesanan;
        foreach ($request->barang_id as $index => $id) {
            $penerimaan->barangs()->attach($id, [
                'jumlah_barang' => $request->jumlah_barang[$index],
                'harga' => $request->harga[$index],
                'unit' => $request->unit_barang[$index],
                // 'pajak' => $request->pajak[$index],
            ]);
        }

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
        $penerimaan->barangs()->detach();
        Penerimaan::destroy($penerimaan->id);

        return redirect('/pembelian/penerimaans');
    }
}
