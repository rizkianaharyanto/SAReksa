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
use App\Services\Stock\ItemService;
use App\Penjualan\Pelanggan;
use App\Penjualan\Penjual;
use PDF;

class RetursController extends Controller
{
    private $itemService;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(ItemService $itemService)
    {
        $this->itemService = $itemService;
    }
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
        
        if(auth()->user()->role != 'retur'){
            return redirect()->back();
        }
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
        // dd($request);
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
            'gudang' => $request->gudang,
            'tanggal' => $request->tanggal,
            'diskon' => 0,
            'diskon_rp' => $request->diskon_rp,
            'biaya_lain' => 0,
            // 'uang_muka' => $request->uang_muka,
            'total_jenis_barang' => $request->akun_barang,
            'total_harga' => $request->total_harga,
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
        $retur = Retur::find($idnya);
        if($retur->status_posting=='sudah posting'){
            return redirect()->back();
        }
        session()->flash('message', 'Retur berhasil diposting');
        session()->flash('status', 'tambah');
        // dd($retur);
        foreach ($retur->barangs as $index => $barang) {
            $b = $barang->pivot->jumlah_barang;
            // dd($barang->id, $retur->gudang, $b);
            try {
                $this->itemService->updateStocks($barang->id, $retur->gudang, $b);
                // dd("berhasil");
            } catch (\Throwable $th) {
                dd('Gagal');
            }
        }

        Retur::where('id', $retur->id)
                    ->update(['status_posting' => 'sudah posting']);
        //posting
        $piutang = Piutang::where('faktur_id', $retur->faktur_id)->first();
                // dd($hutang);
                $sisa = $piutang->sisa - $retur->total_harga;
                $piutang->update([
                    'lunas' => $retur->total_harga,
                    'sisa' => $sisa,
                ]);
                if ($sisa == 0){
                    $piutang->update([
                        'status' => 'lunas',
                    ]);
                    $piutang->faktur()->update([
                        'status' => 'lunas',
                    ]);
                }else{
                    $piutang->faktur()->update([
                        'status' => 'dibayar sebagian',
                    ]);
                }

                // Jurnal
            $no = Jurnal::max('id') + 1;
            for ($i = 1; $i < 3; ++$i) {
                $jurnal = Jurnal::create([
                'kode_jurnal' => 'jur'.$no,
                'retur_id' => $retur->id,
                'tanggal' => $retur->tanggal,
                'debit' => 0,
                'kredit' => 0,
            ]);
                if ($i == 1) {
                    $jurnal->update([
                    'debit' => $retur->total_harga,
                    'akun_id' => 1, //barang
                ]);
                } 
                elseif ($i == 2) {
                    $jurnal->update([
                    'kredit' => $retur->total_harga,
                    'akun_id' => 4, //hutang
                ]);
                }
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
        $total_seluruh_rt = $retur->total_harga;
        $total_harga_rt = [];
        $subtotal_rt = 0;
        foreach ($barangs as $index => $barang) {
            $total_harga_rt[$index] = $barang->pivot->jumlah_barang * $barang->pivot->harga;
            $subtotal_rt += $total_harga_rt[$index];
        }
        return response()
            ->json(['success' => true, 'retur' => $retur, 'barangs' => $barangs,
            'total_seluruh_rt' => $total_seluruh_rt,
            'total_harga_rt' => $total_harga_rt,
            'subtotal_rt' => $subtotal_rt,
            ]);
    }

    public function detail($id)
    {
        $retur = retur::find($id);
        $gudang = Gudang::find($retur->gudang);
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
        return view('penjualan.penjualan.retur.returdetails', [
            'retur' => $retur, 
            'barangs' => $barangs,
            'gudang' => $gudang,
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
        $gudang = Gudang::find($retur->gudang);
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
            'gudang' => $gudang, 
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
        
        if(auth()->user()->role != 'retur'){
            return redirect()->back();
        }
        if (auth()->user()->role == 'piutang' || $retur->status_posting =='sudah posting'){
            return redirect()->back();
        }

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
        // dd($request);
        session()->flash('message', 'Retur berhasil diubah');
        session()->flash('status', 'tambah');
        Retur::where('id', $retur->id)
        ->update([
            // 'pelanggan_id' => $request->pelanggan_id,
            'tanggal' => $request->tanggal,
            'status' => $request->status,
            'total_jenis_barang' => $request->akun_barang,
            'total_harga' => $request->total_harga,
        ]);
        $retur->barangs()->detach();
            foreach ($request->barang_id as $index => $id) {
                $retur->barangs()->attach($id, [
                    'jumlah_barang' => $request->jumlah_barang[$index],
                    'harga' => $request->harga[$index],
                    'unit' => $request->unit_barang[$index],
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
