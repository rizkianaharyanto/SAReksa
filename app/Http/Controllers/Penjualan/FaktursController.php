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
use App\Services\Stock\ItemService;
use App\Stock\Barang;
use App\Stock\Gudang;
use App\Penjualan\Pemasok;
use PDF;

class FaktursController extends Controller
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
        if(auth()->user()->role != 'penjualan'){
            return redirect()->back();
        }
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
    public function store(ItemService $itmSrv,Request $request)
    {
        //Cek
        // dd($request->request);
        $stok = 0;
        if($request->pemesanan_id){
            $allDataBarang = $itmSrv->getAllStocksQty();
            // dd($allDataBarang);
            foreach ($request->barang_id as $index => $id) {
                $kirim = $request->jumlah_barang[$index];
                foreach($allDataBarang as $databarang){
                    if($databarang['id'] == $id){
                        $stok = $databarang['kuantitas_total'];
                    }
                }
                if($stok < $request->jumlah_barang[$index]){
                    session()->flash('message', 'Faktur gagal. Stok kurang');
                    session()->flash('status', 'gagal');
                    return redirect()->back()->with('message', 'Faktur gagal. Stok kurang');
                }
            }
        }
        session()->flash('message', 'Faktur berhasil ditambahkan');
        session()->flash('status', 'tambah');
        $fak = Faktur::max('id') + 1;
        $faktur = Faktur::create([
            'kode_faktur' => 'FKJ-'.$fak,
            'pemesanan_id' => $request->pemesanan_id,
            'pelanggan_id' => $request->pelanggan_id,
            'status' => $request->status,
            'status_posting' => 'belum posting',
            'tanggal' => $request->tanggal,
            'gudang' => $request->gudang,
            'diskon' => $request->diskon,
            'diskon_rp' => $request->disk,
            'biaya_lain' => $request->biaya_lain,
            'uang_muka' => $request->uang_muka,
            'akun_barang' => $request->akun_barang,
            'total_harga' => $request->total_harga_keseluruhan,
            'penjual_id' => $request->penjual_id,
        ]);
        
        if($request->pengiriman_id){
            foreach ($request->pengiriman_id as $pengiriman) {
                Pengiriman::where('id', $pengiriman)->update(['faktur_id' => $faktur->id]);
            }
        }

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

    public function posting(ItemService $itmSrv,$idnya)
    {
        $faktur = Faktur::find($idnya);
        // dd($faktur->barangs);
        if($faktur->status_posting=='sudah posting'){
            return redirect()->back();
        }
        session()->flash('message', 'Faktur berhasil diposting');
        session()->flash('status', 'tambah');
        Faktur::where('id', $faktur->id)
                    ->update(['status_posting' => 'sudah posting']);
                    
                    if($faktur->pemesanan_id == NULL){
                        $cekpemesanan = Pemesanan::where('status' , 'terkirim')->get();
                        Pengiriman::where('faktur_id', $faktur->id)->update(['status' => 'selesai']);
                        // dd($cekpemesanan[8]->pengirimans);
                        foreach($cekpemesanan as $cekpemesanan){
                            $id = $cekpemesanan->id;
                            $cek = 0;
                            $banyak = 0;
                            foreach($cekpemesanan->pengirimans as $cekpengiriman){
                                if($cekpengiriman->status == 'selesai'){
                                    $cek++;
                                }
                                $banyak++;
                                // echo $cek , $banyak;
                            }
                            if ($banyak == $cek){
                                Pemesanan::where('id', $id)->update(['status' => 'selesai']);
                            }
                        }
                        // dd($banyak);
                    }
        
                    //posting
        if ($faktur->status == 'piutang'){
            $pit = Piutang::max('id') + 1;
            $piutang= $faktur->piutang()->create([
                'kode_piutang' => 'PIT-'.$pit,
                'pelanggan_id' => $faktur->pelanggan_id,
                'total_piutang' => $faktur->total_harga,
                'faktur_id' => $faktur->id,
                'sisa' => $faktur->total_harga,
                'status' => 'piutang',
        ]);
            $faktur->update(['piutang_id' => $piutang->id]);
        }
        if ($faktur->pemesanan_id) {
            Pemesanan::find($faktur->pemesanan_id)->update(['status' => 'selesai']);
            $pemesanan = Pemesanan::find($faktur->pemesanan_id)->id;
            $coba = Pengiriman::where('pemesanan_id', $pemesanan)->update(['status' => 'selesai']);
            foreach ($faktur->barangs as $index => $barang) {
                $b = $barang->pivot->jumlah_barang;
                try {
                    $this->itemService->updateStocks($barang->id, $faktur->gudang, ($b*-1));
                    // dd("berhasil");
                } catch (\Throwable $th) {
                    dd('Gagal');
                }
            }
        }
        

        //Jurnals
        if ($faktur->status == 'piutang') {
            $no = Jurnal::max('id') + 1;
            for ($i = 1; $i < 5; ++$i) {
                $jurnal = Jurnal::create([
                        'kode_jurnal' => 'jur'.$no,
                        'tanggal' => $faktur->tanggal,
                        'faktur_id' => $faktur->id,
                        'debit' => 0,
                        'kredit' => 0,
                    ]);
                if ($i == 1) {
                    $jurnal->update([
                            'kredit' => $faktur->akun_barang - $faktur->uang_muka,
                            'akun_id' => 1, //barang
                        ]);
                } elseif ($i == 2) {
                    $jurnal->update([
                            'kredit' => $faktur->biaya_lain,
                            'akun_id' => 3, //biayalain
                        ]);
                } elseif ($i == 3) {
                    $jurnal->update([
                            'debit' => $faktur->piutang->total_piutang,
                            'akun_id' => 4, //piutang
                        ]);
                } elseif ($i == 4) {
                    $jurnal->update([
                            'debit' => $faktur->diskon_rp,
                            'akun_id' => 5, //diskon
                        ]);
                }
            }
        } elseif ($faktur->status == 'lunas') {
            $no = Jurnal::max('id') + 1;
            for ($i = 1; $i < 5; ++$i) {
                $jurnal = Jurnal::create([
                        'kode_jurnal' => 'jur'.$no,
                        'tanggal' => $faktur->tanggal,
                        'faktur_id' => $faktur->id,
                        'debit' => 0,
                        'kredit' => 0,
                    ]);
                if ($i == 1) {
                    $jurnal->update([
                            'kredit' => $faktur->akun_barang - $faktur->uang_muka,
                            'akun_id' => 1, //barang
                        ]);
                } elseif ($i == 2) {
                    $jurnal->update([
                            'kredit' => $faktur->biaya_lain,
                            'akun_id' => 3, //biayalain
                        ]);
                } elseif ($i == 3) {
                    $jurnal->update([
                            'debit' => $faktur->total_harga,
                            'akun_id' => 6, //kas
                        ]);
                } elseif ($i == 4) {
                    $jurnal->update([
                            'debit' => $faktur->diskon_rp,
                            'akun_id' => 5, //diskon
                        ]);
                }
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
        $total_seluruh_fk = $faktur->total_harga;
        $total_harga_fk = [];
        $subtotal_fk = 0;
        foreach ($barangs as $index => $barang) {
            $total_harga_fk[$index] = $barang->pivot->jumlah_barang * $barang->pivot->harga;
            $subtotal_fk += $total_harga_fk[$index];
        }
        return response()
            ->json(['success' => true, 'faktur' => $faktur, 'barangs' => $barangs,
            'total_seluruh_fk' => $total_seluruh_fk,
            'total_harga_fk' => $total_harga_fk,
            'subtotal_fk' => $subtotal_fk,
            ]);
        }

    public function detail($id)
    {
        $faktur = Faktur::find($id);
        $gudang = Gudang::find($faktur->gudang);
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
            'gudang' => $gudang,
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
        $gudang = Gudang::find($faktur->gudang);

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
            'gudang' => $gudang,
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
        if(auth()->user()->role != 'penjualan'){
            return redirect()->back();
        }
        if($faktur->status_posting=='sudah posting' || auth()->user()->role == 'piutang' || auth()->user()->role == 'retur'){
            return redirect()->back();
        }
        // dd($faktur);
        $faktus = faktur::find($faktur);
        // dd($faktus);
        // dd($faktur);
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
    public function update(ItemService $itmSrv, Request $request, Faktur $faktur)
    {
        //cek
        // dd($faktur);
        $stok = 0;
        if($faktur->pemesanan_id){
            $allDataBarang = $itmSrv->getAllStocksQty();
            foreach ($request->barang_id as $index => $id) {
                $kirim = $request->jumlah_barang[$index];
                foreach($allDataBarang as $databarang){
                    if($databarang['id'] == $id){
                        $stok = $databarang['kuantitas_total'];
                    }
                }
                if($stok < $request->jumlah_barang[$index]){
                    session()->flash('message', 'Faktur gagal. Stok kurang');
                    session()->flash('status', 'gagal');
                    return redirect()->back()->with('message', 'Faktur gagal. Stok kurang');
                }
            };
        }
        session()->flash('message', 'Faktur berhasil diedit');
        session()->flash('status', 'tambah');
        Faktur::where('id', $faktur->id)
        ->update([
            'tanggal' => $request->tanggal,
            'diskon' => $request->diskon,
            'biaya_lain' => $request->biaya_lain,
            'total_harga' => $request->total_harga_keseluruhan,
            'penjual_id' => $request->penjual_id,
            'uang_muka' => $request->uang_muka,
            'diskon_rp' => $request->disk,
            'akun_barang' => $request->akun_barang,
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
        session()->flash('message', 'Faktur berhasil dihapus');
        session()->flash('status', 'hapus');
        Faktur::destroy($faktur->id);
        return redirect('/penjualan/fakturs');
    }
}
