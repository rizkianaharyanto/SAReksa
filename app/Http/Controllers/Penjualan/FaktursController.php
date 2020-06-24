<?php

namespace App\Http\Controllers\Penjualan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Penjualan\Faktur;
use App\Penjualan\Piutang;
use App\Penjualan\Jurnal;
use App\Penjualan\Pengiriman;
use App\Penjualan\Pemesanan;
use App\Penjualan\Pelanggan;
use App\Penjualan\Penjual;
use App\Stock\Barang;
use App\Stock\Gudang;
use App\Penjualan\Pemasok;
use PDF;

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
        $fak = Faktur::max('id') + 1;
        $faktur = Faktur::create([
            'kode_faktur' => 'FKJ-'.$fak,
            'pemesanan_id' => $request->pemesanan_id,
            'pelanggan_id' => $request->pelanggan_id,
            'status' => $request->status,
            'status_posting' => 'belum posting',
            'tanggal' => $request->tanggal,
            'diskon' => $request->diskon,
            'diskon_rp' => $request->disk,
            'biaya_lain' => $request->biaya_lain,
            'uang_muka' => $request->uang_muka,
            // 'total_jenis_barang' => 3,
            'total_harga' => $request->total_harga_keseluruhan,
            'penjual_id' => $request->penjual_id,
        ]);
        
        foreach ($request->barang_id as $index => $id) {
            $faktur->barangs()->attach($id, [
                'jumlah_barang' => $request->jumlah_barang[$index],
                'harga' => $request->harga[$index],
                'unit' => $request->unit_barang[$index],
           
                // 'pajak' => $request->pajak[$index],
                // 'status_barang' => $request->status_barang[$index],
            ]);
        }
        return redirect('/penjualan/fakturs');
    }

    public function posting($idnya)
    {
        $faktur = Faktur::find($idnya);
        Faktur::where('id', $faktur->id)
                    ->update(['status_posting' => 'sudah posting']);
        //posting
        if ($faktur->status == 'piutang'){
            $pit = Piutang::max('id') + 1;
            $piutang= $faktur->piutang()->create([
                'kode_piutang' => 'PIT-'.$pit,
                'pelanggan_id' => $faktur->pelanggan_id,
                'total_piutang' => $faktur->total_harga,
                'faktur_id' => $faktur->id,
        ]);
            $faktur->update(['piutang_id' => $piutang->id]);
        }
        if ($faktur->pemesanan_id) {
            Pemesanan::find($faktur->pemesanan_id)->update(['status' => 'selesai']);
            $pemesanan = Pemesanan::find($faktur->pemesanan_id)->id;
            $coba = Pengiriman::where('pemesanan_id', $pemesanan)->update(['status' => 'selesai']);
            // dd($pemesanan, $coba);
        }
        if($faktur->pengirimans){
            foreach($faktur->pengirimans as $pengiriman){
                // dd($penerimaan->id);
                Pengiriman::where('id', $pengiriman->id)->update(['status' => 'selesai']);
            }
        }

        return redirect('/penjualan/fakturs');
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

    public function detail($id)
    {
        $faktur = Faktur::find($id);
        $barangs = $faktur->barangs;
        $diskon = $faktur->diskon_rp;
        $biaya_lain = $faktur->biaya_lain;
        $uang_muka = $faktur->uang_muka;
        $total_seluruh = $faktur->total_harga;
        $total_harga = [];
        $subtotal = 0;
        foreach ($barangs as $index => $barang){
            $total_harga[$index] = $barang->pivot->jumlah_barang * $barang->pivot->harga;
            $subtotal += $total_harga[$index];
        }
        // dd($total_harga, $total_seluruh);
        return view('penjualan.penjualan.faktur.fakturdetails', [
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
        foreach ($barangs as $index => $barang){
            $total_harga[$index] = $barang->pivot->jumlah_barang * $barang->pivot->harga;
            $subtotal += $total_harga[$index];
        }
        $pdf = PDF::loadview('penjualan.penjualan.faktur.faktur-pdf', [
            'faktur' => $faktur, 
            'barangs' => $barangs,
            'diskon' => $diskon,
            'status' => $request->status,
            'biaya_lain' => $biaya_lain,
            'uang_muka' => $uang_muka,
            'total_harga' => $total_harga,
            'subtotal' => $subtotal,
            'total_seluruh' => $total_seluruh,
            ]);

        return $pdf->download('Faktur Penjualan.pdf');
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
            'pengirimans' => Pengiriman::all(),
            'pelanggans' => Pelanggan::all(),
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
        Faktur::where('id', $faktur->id)
        ->update([
            'pelanggan_id' => $request->pelanggan_id,
            'tanggal' => $request->tanggal,
            'diskon' => $request->diskon,
            'biaya_lain' => $request->biaya_lain,
            'total_harga' => $request->total_harga_keseluruhan,
            'penjual_id' => $request->penjual_id,
            'uang_muka' => $request->uang_muka,
            'diskon_rp' => $request->diskon_rp,
            'status' => $request->status,
        ]);
        $faktur->barangs()->detach();
            foreach ($request->barang_id as $index => $id) {
                $faktur->barangs()->attach($id, [
                    'jumlah_barang' => $request->jumlah_barang[$index],
                    'harga' => $request->harga[$index],
                    'unit' => $request->unit_barang[$index],
                    // 'pajak' => $request->pajak[$index],
                    ]);
        }
        return redirect('/penjualan/fakturs');
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
