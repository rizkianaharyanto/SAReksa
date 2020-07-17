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
        $pemasoks = Pemasok::all();
        $fakturs = faktur::all();
        $supplier = null;
        $start = null;
        $end = null;

        return view('pembelian.pembelian.faktur.laporan-faktur', [
            'fakturs' => $fakturs,
            'pemasoks' => $pemasoks,
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
                $pemasoks = Pemasok::all();
                $fakturs = faktur::all();
                $supplier = null;
                $start = null;
                $end = null;
            } else {
                $pemasoks = Pemasok::all();
                $fakturs = faktur::select("pbl_fakturs.*")
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
                $fakturs = faktur::select("pbl_fakturs.*")
                    ->where('pemasok_id', $date->pemasok_id)
                    ->get();
            } else {
                $pemasoks = Pemasok::all();
                $supplier = Pemasok::find($date->pemasok_id);
                $start = $date->start;
                $end = $date->end;
                $fakturs = faktur::select("pbl_fakturs.*")
                    ->where('pemasok_id', $date->pemasok_id)
                    ->whereBetween('tanggal', [$date->start, $date->end])
                    ->get();
            }
        }

        return view('pembelian.pembelian.faktur.laporan-faktur', [
            'fakturs' => $fakturs,
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
                $fakturs = faktur::all();
                $supplier = null;
                $start = null;
                $end = null;
            } else {
                $pemasoks = Pemasok::all();
                $fakturs = faktur::select("pbl_fakturs.*")
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
                $fakturs = faktur::select("pbl_fakturs.*")
                    ->where('pemasok_id', $date->pemasok_id)
                    ->get();
            } else {
                $pemasoks = Pemasok::all();
                $supplier = Pemasok::find($date->pemasok_id);
                $start = $date->start;
                $end = $date->end;
                $fakturs = faktur::select("pbl_fakturs.*")
                    ->where('pemasok_id', $date->pemasok_id)
                    ->whereBetween('tanggal', [$date->start, $date->end])
                    ->get();
            }
        }

        $pdf = PDF::loadview('pembelian.pembelian.faktur.cetak-laporan-faktur', [
            'fakturs' => $fakturs,
            'pemasoks' => $pemasoks,
            'supplier' => $supplier,
            'start' => $start,
            'end' => $end
        ]);

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
            'kode_faktur' => 'FAK-' . $fak,
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
                'kode_hutang' => 'HUT-' . $hut,
                'pemasok_id' => $faktur->pemasok_id,
                'total_hutang' => $request->hutang,
                'sisa' => $request->hutang,
                'tanggal' => $request->tanggal,
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
                    'kode_jurnal' => 'jur' . $no,
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
                    'kode_jurnal' => 'jur' . $no,
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
        $pemasok = Pemasok::find($faktur->pemasok_id);
        $pemesanans = $pemasok->pemesanans()->where('status', 'diterima')->get();
        foreach ($pemesanans as $index => $fakpemesanans) {
            $status = $fakpemesanans->penerimaans()->where('status', 'selesai')->first();
            if ($status == null) {
                $pemesanans[$index] = $fakpemesanans;
            } else {
                $pemesanans[$index] = null;
            }
        }
        $fpemesanans = Pemesanan::find($faktur->pemesanan_id);
        $penerimaans = $pemasok->penerimaans()->where('status', 'sudah posting')->get();
        $fpenerimaans = Penerimaan::where('faktur_id', $faktur->id)->get();
        // dd($pemesanans);
        return view('pembelian.pembelian.faktur.fakturedit', [
            'faktur' => $faktur,
            'penerimaans' => $penerimaans,
            'fpenerimaans' => $fpenerimaans,
            'fpemesanans' => $fpemesanans,
            'pemesanans' => $pemesanans,
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
        // dd($request);
        Pemesanan::find($faktur->pemesanan_id)->update(['status' => 'diterima']);
        $pemesanan = Pemesanan::find($faktur->pemesanan_id)->id;
        Penerimaan::where('pemesanan_id', $pemesanan)->update(['status' => 'sudah posting']);
        // dd($pemesanan, $coba);

        Faktur::where('id', $faktur->id)->update([
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


        if ($request->status == 'hutang') {
            Hutang::where('faktur_id', $faktur->id)->update([
                'pemasok_id' => $faktur->pemasok_id,
                'total_hutang' => $request->hutang,
                'sisa' => $request->hutang,
                'tanggal' => $request->tanggal,
                'faktur_id' => $faktur->id,
                'status' => 'hutang',
            ]);
        } else if ($request->status == 'lunas') {
            Hutang::where('faktur_id', $faktur->id)->update([
                'pemasok_id' => $faktur->pemasok_id,
                'total_hutang' => $request->hutang,
                'lunas' => $request->hutang,
                'sisa' => 0,
                'tanggal' => $request->tanggal,
                'faktur_id' => $faktur->id,
                'status' => 'lunas',
            ]);
        }

        if ($request->pemesanan_id) {
            Pemesanan::find($request->pemesanan_id)->update(['status' => 'selesai']);
            $pemesanan = Pemesanan::find($request->pemesanan_id)->id;
            $coba = Penerimaan::where('pemesanan_id', $pemesanan)->update(['status' => 'selesai']);
            // dd($pemesanan, $coba);
        }

        $faktur->barangs()->detach();
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

    /**
     * Remove the specified resource from storage.
     *
     * @param int  Faktur $faktur
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Faktur $faktur)
    {
        if ($faktur->pemesanan_id) {
            Pemesanan::find($faktur->pemesanan_id)->update(['status' => 'diterima']);
            $pemesanan = Pemesanan::find($faktur->pemesanan_id)->id;
            Penerimaan::where('pemesanan_id', $pemesanan)->update(['status' => 'sudah posting']);
        } else {
            $penerimaans = Penerimaan::where('faktur_id',  $faktur->id)->get();
            foreach ($penerimaans as $penerimaan) {
                Penerimaan::find($penerimaan->id)->update(['status' => 'sudah posting']);
            }
        }
        Hutang::destroy($faktur->hutang->id);
        $faktur->barangs()->detach();
        Faktur::destroy($faktur->id);

        return redirect('/pembelian/fakturs');
    }
}
