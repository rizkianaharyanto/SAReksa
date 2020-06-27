<?php

namespace App\Http\Controllers\Penjualan;

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
use PDF;

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
        session()->flash('message', 'Retur berhasil ditambahkan');
        session()->flash('status', 'tambah');
        $rtp = Retur::max('id') + 1;
        $retur = Retur::create([
            'kode_retur' => 'RTP-'.$rtp,
            'status_posting' => 'belum posting',
            'faktur_id' => $request->faktur_id,
            'status' => $request->status,
            'penjual_id' => $request->penjual_id,
            'pelanggan_id' => $request->pelanggan_id,
            'gudang' => 'gudang',
            'tanggal' => $request->tanggal,
            'diskon' => $request->diskon,
            'diskon_rp' => $request->disk,
            'biaya_lain' => $request->biaya_lain,
            'uang_muka' => $request->uang_muka,
            'total_jenis_barang' => 3,
            'total_harga' => $request->total_harga_keseluruhan,
        ]);

        foreach ($request->barang_id as $index => $id) {
            
            $retur->barangs()->attach($id, [
                'jumlah_barang' => $request->jumlah_barang[$index],
                'harga' => $request->harga[$index],
                'unit' => $request->unit_barang[$index],
                // 'pajak' => $request->pajak[$index],
                // 'status_barang' => $request->status_barang[$index],
            ]);
        }
        return redirect('/penjualan/returs');
    }

    public function posting($idnya)
    {
        session()->flash('message', 'Retur berhasil diposting');
        session()->flash('status', 'tambah');
        $retur = Retur::find($idnya);
        Retur::where('id', $retur->id)
                    ->update(['status_posting' => 'sudah posting']);
        //posting
        if ($retur->status == 'piutang'){
            $pit = Piutang::max('id') + 1;
            $piutang= $retur->piutang()->create([
                'kode_piutang' => 'PIT-'.$pit,
                'pelanggan_id' => $retur->pelanggan_id,
                'total_piutang' => $retur->total_harga * -1,
                'retur_id' => $retur->id,
        ]);
            $retur->update(['piutang_id' => $piutang->id]);
        }
        return redirect('/penjualan/returs');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Retur  $retur
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $retur = Retur::find($id);
        $barangs = $retur->barangs;

        return response()
            ->json(['success' => true, 'retur' => $retur, 'barangs' => $barangs]);
    }

    public function detail($id)
    {
        $retur = retur::find($id);
        $barangs = $retur->barangs;
        $diskon = $retur->diskon_rp;
        $biaya_lain = $retur->biaya_lain;
        $uang_muka = $retur->uang_muka;
        $total_seluruh = $retur->total_harga;
        $total_harga = [];
        $subtotal = 0;
        foreach ($barangs as $index => $barang){
            $total_harga[$index] = $barang->pivot->jumlah_barang * $barang->pivot->harga;
            $subtotal += $total_harga[$index];
        }
        // dd($total_harga, $total_seluruh);
        return view('penjualan.penjualan.retur.returdetails', [
            'retur' => $retur, 
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
        $retur = retur::find($request->id);
        $barangs = $retur->barangs;
        $diskon = $retur->diskon_rp;
        $biaya_lain = $retur->biaya_lain;
        $uang_muka = $retur->uang_muka;
        $total_seluruh = $retur->total_harga;
        $total_harga = [];
        $subtotal = 0;
        foreach ($barangs as $index => $barang){
            $total_harga[$index] = $barang->pivot->jumlah_barang * $barang->pivot->harga;
            $subtotal += $total_harga[$index];
        }
        $pdf = PDF::loadview('penjualan.penjualan.retur.retur-pdf', [
            'retur' => $retur, 
            'barangs' => $barangs,
            'diskon' => $diskon,
            'biaya_lain' => $biaya_lain,
            'uang_muka' => $uang_muka,
            'total_harga' => $total_harga,
            'subtotal' => $subtotal,
            'total_seluruh' => $total_seluruh,
            ]);

        return $pdf->download('retur.pdf');
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
        session()->flash('message', 'Retur berhasil diubah');
        session()->flash('status', 'tambah');
        Retur::where('id', $retur->id)
        ->update([
            'pelanggan_id' => $request->pelanggan_id,
            'tanggal' => $request->tanggal,
            'diskon' => $request->diskon,
            'biaya_lain' => $request->biaya_lain,
            'total_harga' => $request->total_harga_keseluruhan,
            'uang_muka' => $request->uang_muka,
            'diskon_rp' => $request->diskon_rp,
            'status' => $request->status,
        ]);
        $retur->barangs()->detach();
            foreach ($request->barang_id as $index => $id) {
                $retur->barangs()->attach($id, [
                    'jumlah_barang' => $request->jumlah_barang[$index],
                    'harga' => $request->harga[$index],
                    'unit' => $request->unit_barang[$index],
                    // 'pajak' => $request->pajak[$index],
                    ]);
        }
        return redirect('/penjualan/returs');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Retur  $retur
     * @return \Illuminate\Http\Response
     */
    public function destroy(Retur $retur)
    {
        session()->flash('message', 'Retur berhasil dihapus');
        session()->flash('status', 'hapus');
        Retur::destroy($retur->id);
        return redirect('/penjualan/returs');
    }
}
