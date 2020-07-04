<?php

namespace App\Http\Controllers\Pembelian;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Pembelian\Faktur;
use App\Pembelian\Hutang;
use App\Pembelian\Jurnal;
use App\Pembelian\Penerimaan;
use App\Stock\Barang;
use App\Stock\Gudang;
use App\Pembelian\Pemasok;
use App\Pembelian\Pemesanan;
use PDF;

// use App\Pembelian\Akun;
class FaktursController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $fakturs = Faktur::all();

        return view('pembelian.pembelian.faktur.faktur', compact('fakturs'));
    }

    public function laporan()
    {
        $fakturs = Faktur::all();

        return view('pembelian.pembelian.faktur.laporan-faktur', compact('fakturs'));
    }

    public function laporanfilter(Request $date)
    {
        $fakturs = Faktur::select('pbl_fakturs.*')
            ->whereBetween('tanggal', [$date->start, $date->end])
            ->get();

        return view('pembelian.pembelian.faktur.laporan-faktur', compact('fakturs'));
    }

    public function cetaklaporan()
    {
        $fakturs = Faktur::all();

        $pdf = PDF::loadview('pembelian.pembelian.faktur.cetak-laporan-faktur', compact('fakturs'));

        return $pdf->download('laporan-faktur.pdf');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pembelian.pembelian.faktur.fakturinsert', [
            'penerimaans' => Penerimaan::all(),
            'pemasoks' => Pemasok::all(),
            'barangs' => Barang::all(),
            'gudangs' => Gudang::all(),
            // 'akuns'=> Akun::all()
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
        $fak = Faktur::max('id') + 1;
        $faktur = Faktur::create([
            'kode_faktur' => 'FAK-'.$fak,
            'pemesanan_id' => $request->pemesanan_id,
            'pemasok_id' => $request->pemasok_id,
            'status' => $request->status,
            'tanggal' => $request->tanggal,
            'diskon' => $request->diskon,
            'diskon_rp' => $request->disk,
            'biaya_lain' => $request->biaya_lain,
            'uang_muka' => $request->uang_muka,
            'akun_barang' => $request->akun_barang,
            'total_harga' => $request->total_harga_keseluruhan,
            'hutangnya' => $request->hutang,
        ]);

        if ($request->penerimaan_id) {
            foreach ($request->penerimaan_id as $penerimaan) {
                Penerimaan::where('id', $penerimaan)->update(['faktur_id' => $faktur->id]);
            }
        }

        if ($request->status == 'hutang') {
            $hut = Hutang::max('id') + 1;
            $hutang = $faktur->hutang()->create([
                'kode_hutang' => 'HUT-'.$hut,
                'pemasok_id' => $faktur->pemasok_id,
                'total_hutang' => $request->hutang,
                'sisa' => $request->hutang,
                'faktur_id' => $faktur->id,
                'status' => 'hutang',
            ]);
            $faktur->update(['hutang_id' => $hutang->id]);
        }

        if ($request->pemesanan_id) {
            Pemesanan::find($request->pemesanan_id)->update(['status' => 'selesai']);
            $pemesanan = Pemesanan::find($request->pemesanan_id)->id;
            $coba = Penerimaan::where('pemesanan_id', $pemesanan)->update(['status' => 'selesai']);
            // dd($pemesanan, $coba);
        }

        if ($request->penerimaan_id) {
            foreach ($request->penerimaan_id as $penerimaan) {
                // dd($penerimaan->id);
                Penerimaan::where('id', $penerimaan)->update(['status' => 'selesai']);
            }
        }

        foreach ($request->barang_id as $index => $id) {
            $faktur->barangs()->attach($id, [
                'jumlah_barang' => $request->jumlah_barang[$index],
                'harga' => $request->harga[$index],
                'unit' => $request->unit_barang[$index],
                // 'pajak' => $request->pajak[$index],
                // 'status_barang' => $request->status_barang[$index],
            ]);
        }

        return redirect('/pembelian/fakturs');
    }

    public function posting($idnya)
    {
        $faktur = Faktur::find($idnya);
        Faktur::where('id', $faktur->id)
                    ->update(['status_posting' => 'sudah posting']);

        $penerimaan = $faktur->penerimaans;
        foreach ($faktur->penerimaans as $penerimaan) {
            $pemesanan = $penerimaan->pemesanan;
            $status_pesanan = $penerimaan->pemesanan->status;
            $status = $pemesanan->penerimaans->where('status', 'sudah posting')->first();
            // dd($status);
            if ($status_pesanan == 'diterima' && $status == null) {
                $pemesanan->update(array('status' => 'selesai'));
            }
        }

        // dd($faktur->hutang);
        if ($faktur->status == 'hutang') {
            $no = Jurnal::max('id') + 1;
            for ($i = 1; $i < 5; ++$i) {
                $jurnal = Jurnal::create([
                        'kode_jurnal' => 'jur'.$no,
                        'faktur_id' => $faktur->id,
                        'debit' => 0,
                        'kredit' => 0,
                    ]);
                if ($i == 1) {
                    $jurnal->update([
                            'debit' => $faktur->akun_barang - $faktur->uang_muka,
                            'akun_id' => 1, //barang
                        ]);
                } elseif ($i == 2) {
                    $jurnal->update([
                            'debit' => $faktur->biaya_lain,
                            'akun_id' => 3, //biayalain
                        ]);
                } elseif ($i == 3) {
                    $jurnal->update([
                            'kredit' => $faktur->hutang->total_hutang,
                            'akun_id' => 4, //hutang
                        ]);
                } elseif ($i == 4) {
                    $jurnal->update([
                            'kredit' => $faktur->diskon_rp,
                            'akun_id' => 5, //diskon
                        ]);
                }
            }
        } elseif ($faktur->status == 'lunas') {
            $no = Jurnal::max('id') + 1;
            for ($i = 1; $i < 5; ++$i) {
                $jurnal = Jurnal::create([
                        'kode_jurnal' => 'jur'.$no,
                        'faktur_id' => $faktur->id,
                        'debit' => 0,
                        'kredit' => 0,
                    ]);
                if ($i == 1) {
                    $jurnal->update([
                            'debit' => $faktur->akun_barang - $faktur->uang_muka,
                            'akun_id' => 1, //barang
                        ]);
                } elseif ($i == 2) {
                    $jurnal->update([
                            'debit' => $faktur->biaya_lain,
                            'akun_id' => 3, //biayalain
                        ]);
                } elseif ($i == 3) {
                    $jurnal->update([
                            'kredit' => $faktur->hutangnya,
                            'akun_id' => 6, //kas
                        ]);
                } elseif ($i == 4) {
                    $jurnal->update([
                            'kredit' => $faktur->diskon_rp,
                            'akun_id' => 5, //diskon
                        ]);
                }
            }
        }

        return redirect('/pembelian/fakturs');
    }

    /**
     * Display the specified resource.
     *
     * @param int  Faktur $faktur
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $faktur = Faktur::find($id);
        $barangs = $faktur->barangs;

        return response()
            ->json(['success' => true, 'faktur' => $faktur, 'barangs' => $barangs]);
    }

    public function show2($id)
    {
        $faktur = Faktur::find($id);
        $barangs = $faktur->barangs;
        $diskon = $faktur->diskon_rp;
        $biaya_lain = $faktur->biaya_lain;
        $uang_muka = $faktur->uang_muka;
        $total_seluruh = $faktur->total_harga;
        $total_harga = [];
        $subtotal = 0;
        foreach ($barangs as $index => $barang) {
            $total_harga[$index] = $barang->pivot->jumlah_barang * $barang->pivot->harga;
            $subtotal += $total_harga[$index];
        }
        // dd($total_harga, $total_seluruh);
        return view('pembelian.pembelian.faktur.fakturdetails', [
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
        $faktur = faktur::find($request->id);
        $barangs = $faktur->barangs;
        $diskon = $faktur->diskon_rp;
        $biaya_lain = $faktur->biaya_lain;
        $uang_muka = $faktur->uang_muka;
        $total_seluruh = $faktur->total_harga;
        $total_harga = [];
        $subtotal = 0;
        foreach ($barangs as $index => $barang) {
            $total_harga[$index] = $barang->pivot->jumlah_barang * $barang->pivot->harga;
            $subtotal += $total_harga[$index];
        }
        $pdf = PDF::loadview('pembelian.pembelian.faktur.faktur-pdf', [
            'faktur' => $faktur,
            'barangs' => $barangs,
            'diskon' => $diskon,
            'biaya_lain' => $biaya_lain,
            'uang_muka' => $uang_muka,
            'total_harga' => $total_harga,
            'subtotal' => $subtotal,
            'total_seluruh' => $total_seluruh,
            ]);

        return $pdf->download('faktur.pdf');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int  Faktur $faktur
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Faktur $faktur)
    {
        return view('pembelian.pembelian.faktur.fakturedit', [
            'faktur' => $faktur,
            'penerimaans' => Penerimaan::all(),
            'pemasoks' => Pemasok::all(),
            'barangs' => Barang::all(),
            'gudangs' => Gudang::all(),
            // 'akuns'=> Akun::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int  Faktur              $faktur
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Faktur $faktur)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int  Faktur $faktur
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Faktur $faktur)
    {
        Faktur::destroy($faktur->id);

        return redirect('/pembelian/fakturs');
    }
}
