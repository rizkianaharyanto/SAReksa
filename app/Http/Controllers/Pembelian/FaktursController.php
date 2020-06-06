<?php

namespace App\Http\Controllers\Pembelian;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Pembelian\Faktur;
use App\Pembelian\Hutang;
use App\Pembelian\Penerimaan;
use App\Stock\Barang;
use App\Stock\Gudang;
use App\Pembelian\Pemasok;

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
            'no' => Faktur::max('id'),
            'hut' => Hutang::max('id'),
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
        // $faktur = new Faktur();
        // $hutang = new Hutang();
        // $faktur->kode_faktur = $request->kode_faktur;
        // $faktur->pemesanan_id = $request->pemesanan_id;
        // $faktur->pemasok_id = $request->pemasok_id;
        // $faktur->hutang_id = $hutang->id;
        // $faktur->status = $request->status;
        // $faktur->tanggal = $request->tanggal;
        // $faktur->diskon = $request->diskon;
        // $faktur->biaya_lain = $request->biaya_lain;
        // $faktur->uang_muka = $request->uang_muka;
        // // 'total_jenis_barang = 3;
        // $faktur->total_harga = $request->total_harga_keseluruhan;
        // $faktur->save();
        
        // $hutang->kode_hutang = 'hut';
        // $hutang->pemasok_id = $request->pemasok_id;
        // $hutang->total_hutang = $request->hutang;
        // $hutang->faktur_id = $faktur->id;
        // $hutang->save();
        // dd($faktur, $hutang);


        $faktur = Faktur::create([
            'kode_faktur' => $request->kode_faktur,
            'pemesanan_id' => $request->pemesanan_id,
            'pemasok_id' => $request->pemasok_id,
            'status' => $request->status,
            'tanggal' => $request->tanggal,
            'diskon' => $request->diskon,
            'biaya_lain' => $request->biaya_lain,
            'uang_muka' => $request->uang_muka,
            // 'total_jenis_barang' => 3,
            'total_harga' => $request->total_harga_keseluruhan,
        ]);

        $hutang= $faktur->hutang()->create([
            'kode_hutang' => $request->kode_hutang,
            'pemasok_id' => $request->pemasok_id,
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
     * @param  int  Faktur $faktur
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
     * @param  int  Faktur $faktur
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
     * @param  \Illuminate\Http\Request  $request
     * @param  int  Faktur $faktur
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Faktur $faktur)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  Faktur $faktur
     * @return \Illuminate\Http\Response
     */
    public function destroy(Faktur $faktur)
    {
        Faktur::destroy($faktur->id);
        return redirect('/pembelian/fakturs');
    }
}
