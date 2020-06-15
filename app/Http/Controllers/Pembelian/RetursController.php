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
        $ret = Retur::max('id');
        $retur = Retur::create([
            'kode_retur' => 'RET-'.$ret,
            'faktur_id' => $request->faktur_id,
            'status' => $request->status,
            'pemasok_id' => $request->pemasok_id,
            'gudang' => 'gudang',
            'tanggal' => $request->tanggal,
            'diskon' => $request->diskon,
            'diskon_rp' => $request->disk,
            'biaya_lain' => $request->biaya_lain,
            // 'uang_muka' => $request->uang_muka,
            'total_jenis_barang' => 3,
            'total_harga' => $request->total_harga_keseluruhan,
        ]);

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
                    'kredit' => $request->akun_barang,
                    'akun_id' => 1, //barang
                ]);
            } elseif ($i == 2) {
                $jurnal->update([
                    'kredit' => $request->biaya_lain,
                    'akun_id' => 3, //biayalain
                ]);
            } elseif ($i == 3) {
                $jurnal->update([
                    'debit' => $request->hutang,
                    'akun_id' => 4, //hutang
                ]);
            } elseif ($i == 4) {
                $jurnal->update([
                    'debit' => $request->disk,
                    'akun_id' => 5, //diskon
                ]);
            }
        }

        $hut = Hutang::max('id');
        $hutang = $retur->hutang()->create([
            'kode_hutang' => 'HUT-'.$hut,
            'pemasok_id' => $request->pemasok_id,
            'total_hutang' => $request->hutang,
            'retur_id' => $retur->id,
        ]);

        $retur->update(['hutang_id' => $hutang->id]);

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
