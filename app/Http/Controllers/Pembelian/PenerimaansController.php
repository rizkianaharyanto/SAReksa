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

    public function laporan()
    {
        $penerimaans = Penerimaan::all();

        return view('pembelian.pembelian.penerimaan.laporan-penerimaan', compact('penerimaans'));
    }

    public function laporanfilter(Request $date)
    {
        $penerimaans = Penerimaan::select("pbl_penerimaans.*")
            ->whereBetween('tanggal', [$date->start, $date->end])
            ->get();

            return view('pembelian.pembelian.penerimaan.laporan-penerimaan', compact('penerimaans'));
    }

    public function cetaklaporan()
    {
        $penerimaans = Penerimaan::all();

        $pdf = PDF::loadview('pembelian.pembelian.penerimaan.cetak-laporan-penerimaan', compact('penerimaans'));

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
            'kode_penerimaan' => 'PNM-'.$pnm,
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
            'kode_jurnal' => 'jur'.$no,
            'penerimaan_id' => $penerimaan->id,
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
            try {
                $this->itemService->updateStocks($barang->id, $penerimaan->gudang, $b);
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

        return redirect('/pembelian/penerimaans');
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
            ->json(['success' => true, 'penerimaan' => $penerimaan, 'barangs' => $barangs,
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
        $penerimaan->barangs()->detach();
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
        Penerimaan::destroy($penerimaan->id);

        return redirect('/pembelian/penerimaans');
    }
}
