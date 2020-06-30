<?php

namespace App\Http\Controllers\Pembelian;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Pembelian\Pemasok;
use App\Pembelian\Pengirim;

class PemasoksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pemasoks = Pemasok::all();

        return view('pembelian.manajemendata.pemasok', [
            'pemasoks' => $pemasoks,
        ]);
    }

    public function indexbarang()
    {
        $pemasoks = Pemasok::all();

        return view('stock.management-data.pemasok', [
            'pemasoks' => $pemasoks,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
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
        $sup = Pemasok::max('id') + 1;
        $pemasok = Pemasok::create([
            'kode_pemasok' => 'SUP-'.$sup,
            'nama_pemasok' => $request->nama_pemasok,
            'telp_pemasok' => $request->telp_pemasok,
            'email_pemasok' => $request->email_pemasok,
            'alamat_pemasok' => $request->alamat_pemasok,
        ]);

        return redirect('/pembelian/pemasoks');
    }

    /**
     * Display the specified resource.
     *
     * @param int  Pemasok $pemasok
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pemasok = Pemasok::find($id);
        $permintaans = $pemasok->permintaans;
        $pemesanans = $pemasok->pemesanans;
        $pnmpemesanans = $pemasok->pemesanans()->whereNotIn('status', ['diterima', 'selesai'])->get();
        $fpemesanans = $pemasok->pemesanans()->where('status', 'diterima')->get();
        foreach ($fpemesanans as $index => $fakpemesanans) {
            $status = $fakpemesanans->penerimaans()->where('status', 'selesai')->first();
            if ($status == null) {
                $fpemesanans[$index] = $fakpemesanans;
            } else {
                $fpemesanans[$index] = $fakpemesanans->kode_pemesanan;
            }
        }

        $penerimaans = $pemasok->penerimaans;
        $fpenerimaans = $pemasok->penerimaans()->where('status', 'sudah posting')->get();
        $fakturs = $pemasok->fakturs()->where('status', 'hutang')->get();
        $hutangs = $pemasok->hutangs()->where('status', 'hutang')->get();

        return response()
        ->json([
            'pemasok' => $pemasok,
            'permintaans' => $permintaans,
            'pemesanans' => $pemesanans,
            'pnmpemesanans' => $pnmpemesanans,
            'fpemesanans' => $fpemesanans,
            'fpenerimaans' => $fpenerimaans,
            'penerimaans' => $penerimaans,
            'fakturs' => $fakturs,
            'hutangs' => $hutangs,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int  Pemasok $pemasok
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Pemasok $pemasok)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int  Pemasok             $pemasok
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pemasok $pemasok)
    {
        Pemasok::where('id', $pemasok->id)
            ->update([
                'nama_pemasok' => $request->nama_pemasok,
                'telp_pemasok' => $request->telp_pemasok,
                'email_pemasok' => $request->email_pemasok,
                'alamat_pemasok' => $request->alamat_pemasok,
            ]);

        return redirect('/pembelian/pemasoks');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int  Pemasok $pemasok
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pemasok $pemasok)
    {
        $pengirims = $pemasok->pengirims;
        Pemasok::destroy($pemasok->id);
        foreach ($pengirims as $pengirim) {
            Pengirim::destroy($pengirim->id);
        }

        return redirect('/pembelian/pemasoks');
    }
}
