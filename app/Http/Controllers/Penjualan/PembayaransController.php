<?php

namespace App\Http\Controllers\Penjualan;

use App\Http\Controllers\Controller;
use App\Penjualan\Piutang;
use App\Penjualan\Jurnal;
use App\Penjualan\Pelanggan;
use App\Penjualan\Pembayaran;
use Illuminate\Http\Request;
use PDF;

class PembayaransController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pembayarans = Pembayaran::all();
        return view('penjualan.piutang.pembayaran', compact('pembayarans'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pelanggans = Pelanggan::all();
        $piutangs = Piutang::all();

        return view('penjualan.piutang.pembayaraninsert', [
            'pelanggans' => $pelanggans,
            'piutangs' => $piutangs,
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
        $byr = Pembayaran::max('id');
        $pembayaran = Pembayaran::create([
            'kode_pembayaran' => 'BYR-'.$byr,
            'pelanggan_id' => $request->pelanggan_id,
            'tanggal' => $request->tanggal,
            'total' => $request->total_harga,
        ]);

        foreach ($request->piutang_id as $index => $id) {
            $piutang = Piutang::find($id);
            $piutang->update([
                'total_piutang' => $piutang->total_piutang + $request->total_harga * -1,
            ]);
            if ($piutang->faktur_id) {
                $piutang->faktur()->update([
                    'status' => 'lunas',
                ]);
            } elseif ($piutang->retur_id) {
                $piutang->retur()->update([
                    'status' => 'lunas',
                ]);
            }
        }

        foreach ($request->piutang_id as $index => $id) {
            $pembayaran->piutangs()->attach($id, [
                'total' => $request->total_piutang[$index],
            ]);
        }

        return redirect('/penjualan/pembayarans');
    }
    

    /**
     * Display the specified resource.
     *
     * @param  \App\Pembayaran  $pembayaran
     * @return \Illuminate\Http\Response
     */
    public function show( $id)
    {
        $pembayaran = Pembayaran::find($id);
        $piutangs = $pembayaran->piutangs;
        return response()
            ->json(['success' => true, 'piutangs' => $piutangs, 'pembayaran' => $pembayaran]);
    }

    public function detail($id)
    {
        $pembayaran = Pembayaran::find($id);
        $piutangs = $pembayaran->piutangs;
        // dd($total_harga, $total_seluruh);
        return view('penjualan.piutang.pembayarandetails', [
            'pembayaran' => $pembayaran, 
            'piutangs' => $piutangs,
        ]);
    }

    public function cetak_pdf(Request $request)
    {
        $pembayaran = Pembayaran::find($request->id);
        $piutangs = $pembayaran->piutangs;
        // dd($total_harga, $total_seluruh);
        $pdf = PDF::loadview('penjualan.piutang.pembayaran-pdf', [
            'pembayaran' => $pembayaran, 
            'piutangs' => $piutangs,
        ]);
        return $pdf->download('Pembayaran.pdf');

    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Pembayaran  $pembayaran
     * @return \Illuminate\Http\Response
     */
    public function edit(Pembayaran $pembayaran)
    {
        return view('penjualan.piutang.pembayaranedit', [
            'pembayaran' => $pembayaran,
            'pelanggans' => Pemasok::all(),
            'piutangs' => Hutang::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Pembayaran  $pembayaran
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pembayaran $pembayaran)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Pembayaran  $pembayaran
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pembayaran $pembayaran)
    {
                Pembayaran::destroy($pembayaran->id);

        return redirect('/penjualan/pembayarans');
    }
}
