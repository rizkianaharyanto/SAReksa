<?php

namespace App\Http\Controllers\Penjualan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Penjualan\Faktur;
use App\Penjualan\Piutang;
use App\Penjualan\Jurnal;
use App\Penjualan\Pengiriman;
use App\Penjualan\Penjual;
use App\Stock\Barang;
use App\Stock\Gudang;
use App\Penjualan\Pemasok;

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
        return view('penjualan.penjualan.faktur.faktur', compact('fakturs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('penjualan.penjualan.faktur.fakturinsert', [
            'pengirimans' => Pengiriman::all(),
            'penjuals' => Penjual::all(),
            'pelanggans' => Pelanggan::all(),
            'no' => Faktur::max('id'),
            'hut' => Piutang::max('id'),
            'barangs' => Barang::all(),
            'gudangs' => Gudang::all(),
            // 'akuns'=> Akun::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $faktur = Faktur::create([
            'kode_faktur' => $request->kode_faktur,
            'pemesanan_id' => $request->pemesanan_id,
            'pelanggan_id' => $request->pelanggan_id,
            'status' => $request->status,
            'tanggal' => $request->tanggal,
            'diskon' => $request->diskon,
            'diskon_rp' => $request->disk,
            'biaya_lain' => $request->biaya_lain,
            'uang_muka' => $request->uang_muka,
            // 'total_jenis_barang' => 3,
            'total_harga' => $request->total_harga_keseluruhan,
            'penjual_id' => $request->penjual_id,
        ]);

        $no= Jurnal::max('id') + 1;
        for ($i = 1; $i < 5; $i++) {
            $jurnal= Jurnal::create([
                'kode_jurnal' => 'jur'.$no,
                'faktur_id' => $faktur->id,
                'debit' => 0,
                'kredit' => 0
            ]);
            if ($i == 1) {
                $jurnal->update([
                    'debit' => $request->akun_barang,
                    'akun_id' => 1 //barang
                ]);
            }
            else if ($i == 2) {
                $jurnal->update([
                    'debit' => $request->biaya_lain,
                    'akun_id' => 3 //biayalain
                ]);
            }
            else if ($i == 3) {
                $jurnal->update([
                    'kredit' => $request->hutang,
                    'akun_id' => 4 //hutang
                ]);
            }
            else if ($i == 4) {
                $jurnal->update([
                    'kredit' => $request->disk,
                    'akun_id' => 5 //diskon
                ]);
            }
        }

        $hutang= $faktur->hutang()->create([
            'kode_hutang' => $request->kode_hutang,
            'pelanggan_id' => $request->pelanggan_id,
            'total_hutang' => $request->hutang,
            'faktur_id' => $faktur->id,
        ]);

        $faktur->update(['hutang_id' => $hutang->id]);

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
     * Display the specified resource.
     *
     * @param  \App\Faktur  $faktur
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $faktur = Faktur::find($id);
        $barangs = $faktur->barangs;
        return response()
            ->json(['success' => true, 'faktur' => $faktur, 'barangs' => $barangs]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Faktur  $faktur
     * @return \Illuminate\Http\Response
     */
    public function edit(Faktur $faktur)
    {
        return view('penjualan.penjualan.faktur.fakturedit', [
            'faktur' => $faktur,
            'penjuals' => Penjual::all(),
            'pengiriman' => Pengiriman::all(),
            'Pelanggan' => Pelanggan::all(),
            'barangs' => Barang::all(),
            'gudangs' => Gudang::all(),
            // 'akuns'=> Akun::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Faktur  $faktur
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Faktur $faktur)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Faktur  $faktur
     * @return \Illuminate\Http\Response
     */
    public function destroy(Faktur $faktur)
    {
        Faktur::destroy($faktur->id);
        return redirect('/penjualan/fakturs');
    }
}
