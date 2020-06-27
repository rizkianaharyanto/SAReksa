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
        session()->flash('message', 'Pembayaran berhasil ditambahkan');
        session()->flash('status', 'tambah');
        $byr = Pembayaran::max('id') + 1;
        $pembayaran = Pembayaran::create([
            'kode_pembayaran' => 'BYR-'.$byr,
            'pelanggan_id' => $request->pelanggan_id,
            'tanggal' => $request->tanggal,
            'total' => $request->total_harga,
            'status_posting' => 'belum posting',
        ]);


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

    public function posting($idnya)
    {
        
        session()->flash('message', 'Pembayaran berhasil diposting');
        session()->flash('status', 'tambah');
        $pembayaran = Pembayaran::find($idnya);
        Pembayaran::where('id', $pembayaran->id)
                    ->update(['status_posting' => 'sudah posting']);
        //posting
        foreach ($pembayaran->piutangs as $pembayaran) {
            $piutang = Piutang::find($pembayaran->pivot->piutang_id);
            $piutang->update([
                'lunas' => $pembayaran->pivot->total,
                'total_piutang' => $piutang->total_piutang - $pembayaran->pivot->total,
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
        return redirect('/penjualan/fakturs');
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Pembayaran  $pembayaran
     * @return \Illuminate\Http\Response
     */
    public function edit(Pembayaran $pembayaran)
    {
        // dd($pembayaran->piutangs);
        return view('penjualan.piutang.pembayaranedit', [
            'pembayaran' => $pembayaran,
            'pelanggans' => Pelanggan::all(),
            'piutangs' => Piutang::all(),
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
        
        session()->flash('message', 'Pembayaran berhasil diubah');
        session()->flash('status', 'tambah');
        Pembayaran::where('id', $pembayaran->id)
        ->update([
            'tanggal' => $request->tanggal,
            'total' => $request->total_harga,
        ]);
        $pembayaran->piutangs()->detach();
        foreach ($request->piutang_id as $index => $id) {
            $pembayaran->piutangs()->attach($id, [
                'total' => $request->total_piutang[$index],
            ]);
        }
        return redirect('/penjualan/pembayarans');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Pembayaran  $pembayaran
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pembayaran $pembayaran)
    {
        
        session()->flash('message', 'Pembayaran berhasil dihapus');
        session()->flash('status', 'hapus');
        Pembayaran::destroy($pembayaran->id);
        return redirect('/penjualan/pembayarans');
    }
}
