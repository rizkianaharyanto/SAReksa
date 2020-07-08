<?php

namespace App\Http\Controllers\Penjualan;

use App\Http\Controllers\Controller;
use App\Penjualan\Hutang;
use App\Penjualan\Jurnal;
use Illuminate\Http\Request;
use App\Penjualan\Pengiriman;
use App\Penjualan\Pemesanan;
use App\Stock\Barang;
use App\Stock\Gudang;
use App\Http\Requests\Stock\CreateItemsRequest;
use App\Services\Stock\ItemService;
use App\Penjualan\Pelanggan;
use App\Penjualan\Penjual;
use App\Stock\HargaRetailHistory;

use PDF;

class PengirimansController extends Controller
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

    public function index()
    {
        $pengirimans = Pengiriman::all();
        return view('penjualan.penjualan.pengiriman.pengiriman', compact('pengirimans'));
    }


// ================================================================================================
    public function stokkeluar()
    {
        $pengirimans = Pengiriman::all();
        $barangs = collect([]);
        foreach ($pengirimans as $pengiriman) {
            $barangs->push($pengiriman->barangs);
        }
        $count=$barangs->count();
        // dd($count);
        return view('stock.transactions.stock-keluar.index', [
            'pengirimans' => $pengirimans,
            'barangs' => $count,
        ]);
    }
    
    public function stokkeluardetail($id)
    {
        $pengiriman = Pengiriman::find($id);
        $gudang = Gudang::find($pengiriman->gudang);
        $barangs = $pengiriman->barangs;
        $diskon = $pengiriman->diskon_rp;
        $biaya_lain = $pengiriman->biaya_lain;
        $total_seluruh = $pengiriman->total_harga;
        $total_harga = [];
        $subtotal = 0;
        foreach ($barangs as $index => $barang){
            $total_harga[$index] = $barang->pivot->jumlah_barang * $barang->pivot->harga;
            $subtotal += $total_harga[$index];
        }
        // dd($total_harga, $total_seluruh);
        return view('stock.transactions.stock-keluar.details', [
            'pengiriman' => $pengiriman, 
            'gudang' => $gudang,
            'barangs' => $barangs,
            'diskon' => $diskon,
            'biaya_lain' => $biaya_lain,
            'total_harga' => $total_harga,
            'subtotal' => $subtotal,
            'total_seluruh' => $total_seluruh,
        ]);
    }
// ================================================================================================

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('penjualan.penjualan.pengiriman.pengirimaninsert', [
            'pelanggans' => Pelanggan::all(),
            'pemesanans' => Pemesanan::all(),
            'barangs' => Barang::all(),
            'penjuals' => Penjual::all(),
            'gudangs' => Gudang::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ItemService $itmSrv, Request $request)
    {
        //Cek Stok
        $stok = 0;
        $allDataBarang = $itmSrv->getAllStocksQty();
        foreach ($request->barang_id as $index => $id) {
            $kirim = $request->jumlah_barang[$index];
            foreach($allDataBarang as $databarang){
                if($databarang['id'] == $id){
                    $stok = $databarang['kuantitas_total'];
                }
            }
            if($stok < $request->jumlah_barang[$index]){
                session()->flash('message', 'Pengiriman gagal. Stok kurang');
                session()->flash('status', 'gagal');
                return redirect()->back()->with('message', 'Pengiriman gagal. Stok kurang');
            }
        }
        // dd($request);
        session()->flash('message', 'Pengiriman berhasil ditambahkan');
        session()->flash('status', 'tambah');
        $pgr = Pengiriman::max('id') + 1;
        // dd($request->akun_barang);
        $pengiriman = Pengiriman::create([
            'kode_pengiriman' => 'PGR-'.$pgr,
            'pemesanan_id' => $request->pemesanan_id,
            'status' => 'dalam pengiriman',
            'pelanggan_id' => $request->pelanggan_id,
            'gudang' => $request->gudang,
            'tanggal' => $request->tanggal,
            'diskon' => $request->diskon,
            'diskon_rp' => $request->disk,
            'biaya_lain' => $request->biaya_lain,
            'total_jenis_barang' =>  $request->akun_barang,
            'penjual_id' => $request->penjual_id,
            'total_harga' => $request->total_harga_keseluruhan,
        ]);

        // dd($jurnal);
        $pemesanan = $pengiriman->pemesanan;
        foreach ($request->barang_id as $index => $id) {
            $pengiriman->barangs()->attach($id, [
                'jumlah_barang' => $request->jumlah_barang[$index],
                'harga' => $request->harga[$index],
                'unit' => $request->unit_barang[$index],
                // 'pajak' => $request->pajak[$index],
            ]);

        }
        return redirect('/penjualan/pengirimans');      
    }   

    public function posting(ItemService $itmSrv, $idnya)
    {
        $stok = 0;
        session()->flash('message', 'Pengiriman berhasil diposting');
        session()->flash('status', 'tambah');
        $pengiriman = Pengiriman::find($idnya);
        $pemesanan = $pengiriman->pemesanan;
        $allDataBarang = $itmSrv->getAllStocksQty();

        foreach ($pengiriman->barangs as $index => $barang) {
            $a = $pemesanan->barangs()->where('barang_id', $barang->id)->first()->pivot->barang_belum_diterima;
            $b = $barang->pivot->jumlah_barang;
            $belum_diterima = $a - $b;

            // dd($allDataBarang);
            foreach($allDataBarang as $databarang){
                // dd($databarang['id']);
                if($databarang['id'] == $barang->id){
                    $stok = $databarang['kuantitas_total'];
                }
            }

            if($stok >= $b){
                //update stock
                try {
                    $this->itemService->updateStocks($barang->id, $pengiriman->gudang, ($b*-1));
                    // dd("berhasil");
                } catch (\Throwable $th) {
                    dd('Gagal');
                }
            }else {
                session()->flash('message', 'Stok kurang');
                session()->flash('status', '');
                return redirect('/penjualan/pengirimans');
            }

            $pemesanan->barangs()->where('barang_id', $barang->id)->update(array('barang_belum_diterima' => $belum_diterima));
            if ($belum_diterima == 0) {
                $pemesanan->barangs()->where('barang_id', $barang->id)->update(array('status_barang' => 'terkirim'));
            } else {
                $pemesanan->barangs()->where('barang_id', $barang->id)->update(array('status_barang' => 'belum terkirim'));
            }
        }

        Pengiriman::where('id', $pengiriman->id)
                    ->update(['status' => 'sudah posting']);
        //posting

        $no = Jurnal::max('id') + 1;
        for ($i = 1; $i < 3; ++$i) {
            $jurnal = Jurnal::create([
            'kode_jurnal' => 'jur'.$no,
            'pengiriman_id' => $pengiriman->id,
            'debit' => 0,
            'kredit' => 0,
        ]);
            if ($i == 1) {
                $jurnal->update([
                    'kredit' => $pengiriman->total_jenis_barang,
                    'akun_id' => 1, //barang
                ]);
            } elseif ($i == 2) {
                $jurnal->update([
                    'debit' => $pengiriman->total_jenis_barang,
                    'akun_id' => 2, //barang belum ditagih
                ]);
            }
        }

        
        $status = $pemesanan->barangs()->where('status_barang', 'belum terkirim')->first();
        // dd($status);
            if ($status) {
                $pemesanan->update(array('status' => 'terkirim sebagian'));
            }else{
                $pemesanan->update(array('status' => 'terkirim'));
            }
        
        return redirect('/penjualan/pengirimans');
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Pengiriman  $pengiriman
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pengiriman = Pengiriman::find($id);
        $barangs = $pengiriman->barangs;
        // dd($barangs);
        return response()
            ->json(['success' => true, 'pengiriman' => $pengiriman, 'barangs' => $barangs]);
    }

    public function detail($id)
    {
        $pengiriman = Pengiriman::find($id);
        $gudang = Gudang::find($pengiriman->gudang);
        $barangs = $pengiriman->barangs;
        $diskon = $pengiriman->diskon_rp;
        $biaya_lain = $pengiriman->biaya_lain;
        $total_seluruh = $pengiriman->total_harga;
        $total_harga = [];
        $subtotal = 0;
        foreach ($barangs as $index => $barang){
            $total_harga[$index] = $barang->pivot->jumlah_barang * $barang->pivot->harga;
            $subtotal += $total_harga[$index];
        }
        // dd($total_harga, $total_seluruh);
        return view('penjualan.penjualan.pengiriman.pengirimandetails', [
            'pengiriman' => $pengiriman, 
            'gudang' => $gudang,
            'barangs' => $barangs,
            'diskon' => $diskon,
            'biaya_lain' => $biaya_lain,
            'total_harga' => $total_harga,
            'subtotal' => $subtotal,
            'total_seluruh' => $total_seluruh,
        ]);
    }

    public function cetak_pdf(Request $request)
    {
        $pengiriman = pengiriman::find($request->id);
        $gudang = Gudang::find($pengiriman->gudang);
        $barangs = $pengiriman->barangs;
        $diskon = $pengiriman->diskon_rp;
        $biaya_lain = $pengiriman->biaya_lain;
        $total_seluruh = $pengiriman->total_harga;
        $total_harga = [];
        $subtotal = 0;
        foreach ($barangs as $index => $barang){
            $total_harga[$index] = $barang->pivot->jumlah_barang * $barang->pivot->harga;
            $subtotal += $total_harga[$index];
        }
        $pdf = PDF::loadview('penjualan.penjualan.pengiriman.pengiriman-pdf', [
            'pengiriman' => $pengiriman, 
            'gudang' => $gudang,
            'barangs' => $barangs,
            'diskon' => $diskon,
            'biaya_lain' => $biaya_lain,
            'total_harga' => $total_harga,
            'subtotal' => $subtotal,
            'total_seluruh' => $total_seluruh,
            ]);

        return $pdf->download('Pengiriman.pdf');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Pengiriman  $pengiriman
     * @return \Illuminate\Http\Response
     */
    public function edit(Pengiriman $pengiriman)
    {
        return view('penjualan.penjualan.pengiriman.pengirimanedit', [
            'pengiriman' => $pengiriman,
            'pelanggans' => Pelanggan::all(),
            'barangs' => Barang::all(),
            'penjuals' => Penjual::all(),
            'gudangs' => Gudang::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Pengiriman  $pengiriman
     * @return \Illuminate\Http\Response
     */
    public function update(ItemService $itmSrv, Request $request, Pengiriman $pengiriman)
    {
        $stok = 0;
        $pemesanan = $pengiriman->pemesanan;
        //Cek stock
        $allDataBarang = $itmSrv->getAllStocksQty();
        foreach ($request->barang_id as $index => $id) {
            $kirim = $request->jumlah_barang[$index];
            foreach($allDataBarang as $databarang){
                if($databarang['id'] == $id){
                    $stok = $databarang['kuantitas_total'];
                }
            }
            if($stok < $request->jumlah_barang[$index]){
                session()->flash('message', 'Pengiriman gagal. Stok kurang');
                session()->flash('status', 'gagal');
                return redirect()->back()->with('message', 'Pengiriman gagal. Stok kurang');
            }
        }
        // dd($request->akun_barang);
        
        // dd($request);
        session()->flash('message', 'Pengiriman berhasil dikonfirmasi');
        session()->flash('status', 'tambah');
        Pengiriman::where('id', $pengiriman->id)
            ->update([
                'kode_pengiriman' => $request->kode_pengiriman,
                'pelanggan_id' => $request->pelanggan_id,
                'gudang' => $request->gudang,
                'status' => 'terkirim',
                'tanggal' => $request->tanggal,
                'diskon' => $request->diskon,
                'diskon_rp' => $request->disk,
                'biaya_lain' => $request->biaya_lain,
                'total_jenis_barang' => $request->akun_barang,
                'total_harga' => $request->total_harga_keseluruhan,
                'penjual_id' => $request->penjual_id,
            ]);
            $pengiriman->barangs()->detach();
            foreach ($request->barang_id as $index => $id) {
                $pengiriman->barangs()->attach($id, [
                    'jumlah_barang' => $request->jumlah_barang[$index],
                    'harga' => $request->harga[$index],
                    'unit' => $request->unit_barang[$index],
                    // 'pajak' => $request->pajak[$index],
                    ]);
        }

        $pemesanan->update(array('status' => 'terkirim sebagian'));
        return redirect('/penjualan/pengirimans');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Pengiriman  $pengiriman
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pengiriman $pengiriman)
    {
        session()->flash('message', 'Pengiriman berhasil dihapus');
        session()->flash('status', 'hapus');
        Pengiriman::destroy($pengiriman->id);
        return redirect('/penjualan/pengirimans');
    }
}
