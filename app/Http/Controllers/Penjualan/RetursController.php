<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Penjualan\Retur;
use App\Penjualan\Faktur;
use App\Penjualan\Piutang;
use App\Penjualan\Jurnal;
use App\Stock\Barang;
use App\Stock\Gudang;
use App\Penjualan\Pelanggan;
use App\Penjualan\Penjual;

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
        return view('penjualan.penjualan.retur.retur', compact('returs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('penjualan.penjualan.retur.returinsert', [
            'pelanggans' => Pelanggan::all(),
            'no' => Retur::max('id'),
            'hut' => Piutang::max('id'),
            'fakturs' => Faktur::all(),
            'barangs' => Barang::all(),
            'gudangs'=> Gudang::all(),
            'penjuals'=> Penjual::all(),
            // 'akuns'=> Akun::all(),
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
        $retur = Retur::create([
            'kode_retur' => $request->kode_retur,
            'faktur_id' => $request->faktur_id,
            'status' => $request->status,
            'penjual_id' => $request->penjual_id,
            'pelanggan_id' => $request->pelanggan_id,
            'gudang' => 'gudang',
            'tanggal' => $request->tanggal,
            'diskon' => $request->diskon,
            'diskon_rp' => $request->disk,
            'biaya_lain' => $request->biaya_lain,
            // 'uang_muka' => $request->uang_muka,
            'total_jenis_barang' => 3,
            'total_harga' => $request->total_harga_keseluruhan,
        ]);
        $no= Jurnal::max('id') + 1;
        for ($i = 1; $i < 5; $i++) {
            $jurnal= Jurnal::create([
                'kode_jurnal' => 'jur'.$no,
                'retur_id' => $retur->id,
                'debit' => 0,
                'kredit' => 0
            ]);
            if ($i == 1) {
                $jurnal->update([
                    'kredit' => $request->akun_barang,
                    'akun_id' => 1 //barang
                ]);
            }
            else if ($i == 2) {
                $jurnal->update([
                    'kredit' => $request->biaya_lain,
                    'akun_id' => 3 //biayalain
                ]);
            }
            else if ($i == 3) {
                $jurnal->update([
                    'debit' => $request->piutang,
                    'akun_id' => 4 //piutang
                ]);
            }
            else if ($i == 4) {
                $jurnal->update([
                    'debit' => $request->disk,
                    'akun_id' => 5 //diskon
                ]);
            }
        }

        $piutang= $retur->piutang()->create([
            'kode_piutang' => $request->kode_piutang,
            'pelanggan_id' => $request->pelanggan_id,
            'total_piutang' => $request->piutang,
            'retur_id' => $retur->id,
        ]);

        $retur->update(['piutang_id' => $piutang->id]);

        foreach ($request->barang_id as $index => $id) {

            $retur->barangs()->attach($id, [
                'jumlah_barang' => $request->jumlah_barang[$index],
                'harga' => $request->harga[$index],
                'unit' => $request->unit[$index],
                'pajak' => $request->pajak[$index],
                'status_barang' => $request->status_barang[$index],
            ]);
        }
        return redirect('/penjualan/returs');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Retur  $retur
     * @return \Illuminate\Http\Response
     */
    public function show(Retur $retur)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Retur  $retur
     * @return \Illuminate\Http\Response
     */
    public function edit(Retur $retur)
    {
        return view('penjualan.penjualan.retur.returedit', [
            'retur' => $retur,
            'pelanggans' => Pelanggan::all(),
            'fakturs' => Faktur::all(),
            'penjuals'=> Penjual::all(),
            'barangs' => Barang::all(),
            'gudangs'=> Gudang::all(),
            // 'akuns'=> Akun::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Retur  $retur
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Retur $retur)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Retur  $retur
     * @return \Illuminate\Http\Response
     */
    public function destroy(Retur $retur)
    {
        Retur::destroy($retur->id);
        return redirect('/penjualan/returs');
    }
}
