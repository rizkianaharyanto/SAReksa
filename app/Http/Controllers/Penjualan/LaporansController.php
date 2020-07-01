<?php

namespace App\Http\Controllers\Penjualan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Penjualan\Penawaran;
use App\Penjualan\Pemesanan;
use App\Penjualan\Pelanggan;
use App\Penjualan\Pengiriman;
use App\Penjualan\Faktur;
use App\Penjualan\Retur;
use App\Penjualan\Pembayaran;
use App\Penjualan\Piutang;


use PDF;


class LaporansController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('penjualan.laporan.laporan', [
            'pelanggans' => Pelanggan::all()]);
    }

    public function penawaran(Request $request)
    {
        $bulanangka = $request->bulan;
        if($request->bulan == 1){  $bulan = 'Januari';}
        if($request->bulan == 2){  $bulan = 'Februari';}
        if($request->bulan == 3){  $bulan = 'Maret';}
        if($request->bulan == 4){  $bulan = 'April';}
        if($request->bulan == 5){  $bulan = 'Mei';}
        if($request->bulan == 6){  $bulan = 'Juni';}
        if($request->bulan == 7){  $bulan = 'Juli';}
        if($request->bulan == 8){  $bulan = 'Agustus';}
        if($request->bulan == 9){  $bulan = 'September';}
        if($request->bulan == 10){  $bulan = 'Oktober';}
        if($request->bulan == 11){  $bulan = 'Novermber';}
        if($request->bulan == 12){  $bulan = 'Desember';}

        $tahun = $request->tahun;
        // dd($request);
        $penawarans = Penawaran::whereMonth('tanggal',$request->bulan)
            ->whereYear('tanggal',$tahun)
            ->get();
            $total = 0;

            foreach ($penawarans as $penawaran) {
                $total = $penawaran->sum('total_harga');
               
            }
        // dd($penawarans);
        return view('penjualan.laporan.laporan-penawaran',  [
            'penawaran' => $penawarans,
            'bulan' => $bulan,
            'bulanangka' => $bulanangka,
            'tahun' => $tahun,
            'total' => $total,
        ]);
    }

    public function cetakpenawaran(Request $request)
    {
        // dd($request);
        if($request->bulan_angka == 1){  $bulan = 'Januari';}
        if($request->bulan_angka == 2){  $bulan = 'Februari';}
        if($request->bulan_angka == 3){  $bulan = 'Maret';}
        if($request->bulan_angka == 4){  $bulan = 'April';}
        if($request->bulan_angka == 5){  $bulan = 'Mei';}
        if($request->bulan_angka == 6){  $bulan = 'Juni';}
        if($request->bulan_angka == 7){  $bulan = 'Juli';}
        if($request->bulan_angka == 8){  $bulan = 'Agustus';}
        if($request->bulan_angka == 9){  $bulan = 'September';}
        if($request->bulan_angka == 10){  $bulan = 'Oktober';}
        if($request->bulan_angka == 11){  $bulan = 'Novermber';}
        if($request->bulan_angka == 12){  $bulan = 'Desember';}

        $tahun = $request->tahun;
        // dd($request);
        $penawarans = Penawaran::whereMonth('tanggal',$request->bulan_angka)
            ->whereYear('tanggal',$tahun)
            ->get();
        
            $total = 0;
            foreach ($penawarans as $penawaran) {
                $total = $penawaran->sum('total_harga');
               
            }

        $pdf = PDF::loadview('penjualan.laporan.cetak-laporan-penawaran' ,  [
            'penawaran' => $penawarans,
            'bulan' => $bulan,
            'tahun' => $tahun,
            'total' => $total,
        ]);

        return $pdf->download('laporan-penawaran.pdf');
    }

    public function pemesanan(Request $request)
    {
        $bulanangka = $request->bulan;
        if($request->bulan == 1){  $bulan = 'Januari';}
        if($request->bulan == 2){  $bulan = 'Februari';}
        if($request->bulan == 3){  $bulan = 'Maret';}
        if($request->bulan == 4){  $bulan = 'April';}
        if($request->bulan == 5){  $bulan = 'Mei';}
        if($request->bulan == 6){  $bulan = 'Juni';}
        if($request->bulan == 7){  $bulan = 'Juli';}
        if($request->bulan == 8){  $bulan = 'Agustus';}
        if($request->bulan == 9){  $bulan = 'September';}
        if($request->bulan == 10){  $bulan = 'Oktober';}
        if($request->bulan == 11){  $bulan = 'Novermber';}
        if($request->bulan == 12){  $bulan = 'Desember';}

        $tahun = $request->tahun;
        // dd($request);
        $pemesanans = Pemesanan::whereMonth('tanggal',$request->bulan)
            ->whereYear('tanggal',$tahun)
            ->get();
            $total = 0;

            foreach ($pemesanans as $pemesanan) {
                $total = $pemesanan->sum('total_harga');
               
            }
        // dd($penawarans);
        return view('penjualan.laporan.laporan-pemesanan',  [
            'pemesanan' => $pemesanans,
            'bulan' => $bulan,
            'bulanangka' => $bulanangka,
            'tahun' => $tahun,
            'total' => $total,
        ]);
    }

    public function cetakpemesanan(Request $request)
    {
        // dd($request);
        if($request->bulan_angka == 1){  $bulan = 'Januari';}
        if($request->bulan_angka == 2){  $bulan = 'Februari';}
        if($request->bulan_angka == 3){  $bulan = 'Maret';}
        if($request->bulan_angka == 4){  $bulan = 'April';}
        if($request->bulan_angka == 5){  $bulan = 'Mei';}
        if($request->bulan_angka == 6){  $bulan = 'Juni';}
        if($request->bulan_angka == 7){  $bulan = 'Juli';}
        if($request->bulan_angka == 8){  $bulan = 'Agustus';}
        if($request->bulan_angka == 9){  $bulan = 'September';}
        if($request->bulan_angka == 10){  $bulan = 'Oktober';}
        if($request->bulan_angka == 11){  $bulan = 'Novermber';}
        if($request->bulan_angka == 12){  $bulan = 'Desember';}

        $tahun = $request->tahun;
        // dd($request);
        $pemesanans = Pemesanan::whereMonth('tanggal',$request->bulan_angka)
            ->whereYear('tanggal',$tahun)
            ->get();
        
            $total = 0;
            foreach ($pemesanans as $pemesanan) {
                $total = $pemesanan->sum('total_harga');
               
            }

        $pdf = PDF::loadview('penjualan.laporan.cetak-laporan-pemesanan' ,  [
            'pemesanan' => $pemesanans,
            'bulan' => $bulan,
            'tahun' => $tahun,
            'total' => $total,
        ]);

        return $pdf->download('laporan-pemesanan.pdf');
    }

    public function pengiriman(Request $request)
    {
        $bulanangka = $request->bulan;
        if($request->bulan == 1){  $bulan = 'Januari';}
        if($request->bulan == 2){  $bulan = 'Februari';}
        if($request->bulan == 3){  $bulan = 'Maret';}
        if($request->bulan == 4){  $bulan = 'April';}
        if($request->bulan == 5){  $bulan = 'Mei';}
        if($request->bulan == 6){  $bulan = 'Juni';}
        if($request->bulan == 7){  $bulan = 'Juli';}
        if($request->bulan == 8){  $bulan = 'Agustus';}
        if($request->bulan == 9){  $bulan = 'September';}
        if($request->bulan == 10){  $bulan = 'Oktober';}
        if($request->bulan == 11){  $bulan = 'Novermber';}
        if($request->bulan == 12){  $bulan = 'Desember';}

        $tahun = $request->tahun;
        // dd($request);
        $pengirimans = Pengiriman::whereMonth('tanggal',$request->bulan)
            ->whereYear('tanggal',$tahun)
            ->get();
            $total = 0;

            foreach ($pengirimans as $pengiriman) {
                $total = $pengiriman->sum('total_harga');
               
            }
        // dd($penawarans);
        return view('penjualan.laporan.laporan-pengiriman',  [
            'pengiriman' => $pengirimans,
            'bulan' => $bulan,
            'bulanangka' => $bulanangka,
            'tahun' => $tahun,
            'total' => $total,
        ]);
    }

    public function cetakpengiriman(Request $request)
    {
        // dd($request);
        if($request->bulan_angka == 1){  $bulan = 'Januari';}
        if($request->bulan_angka == 2){  $bulan = 'Februari';}
        if($request->bulan_angka == 3){  $bulan = 'Maret';}
        if($request->bulan_angka == 4){  $bulan = 'April';}
        if($request->bulan_angka == 5){  $bulan = 'Mei';}
        if($request->bulan_angka == 6){  $bulan = 'Juni';}
        if($request->bulan_angka == 7){  $bulan = 'Juli';}
        if($request->bulan_angka == 8){  $bulan = 'Agustus';}
        if($request->bulan_angka == 9){  $bulan = 'September';}
        if($request->bulan_angka == 10){  $bulan = 'Oktober';}
        if($request->bulan_angka == 11){  $bulan = 'Novermber';}
        if($request->bulan_angka == 12){  $bulan = 'Desember';}

        $tahun = $request->tahun;
        // dd($request);
        $pengirimans = Pengiriman::whereMonth('tanggal',$request->bulan_angka)
            ->whereYear('tanggal',$tahun)
            ->get();
        
            $total = 0;
            foreach ($pengirimans as $pengiriman) {
                $total = $pengiriman->sum('total_harga');
               
            }

        $pdf = PDF::loadview('penjualan.laporan.cetak-laporan-pengiriman' ,  [
            'pengiriman' => $pengirimans,
            'bulan' => $bulan,
            'tahun' => $tahun,
            'total' => $total,
        ]);

        return $pdf->download('laporan-pengiriman.pdf');
    }

    public function faktur(Request $request)
    {
        $bulanangka = $request->bulan;
        if($request->bulan == 1){  $bulan = 'Januari';}
        if($request->bulan == 2){  $bulan = 'Februari';}
        if($request->bulan == 3){  $bulan = 'Maret';}
        if($request->bulan == 4){  $bulan = 'April';}
        if($request->bulan == 5){  $bulan = 'Mei';}
        if($request->bulan == 6){  $bulan = 'Juni';}
        if($request->bulan == 7){  $bulan = 'Juli';}
        if($request->bulan == 8){  $bulan = 'Agustus';}
        if($request->bulan == 9){  $bulan = 'September';}
        if($request->bulan == 10){  $bulan = 'Oktober';}
        if($request->bulan == 11){  $bulan = 'Novermber';}
        if($request->bulan == 12){  $bulan = 'Desember';}

        $tahun = $request->tahun;
        // dd($request);
        $fakturs = Faktur::whereMonth('tanggal',$request->bulan)
            ->whereYear('tanggal',$tahun)
            ->get();
            $total = 0;

            foreach ($fakturs as $faktur) {
                $total = $faktur->sum('total_harga');
               
            }
        // dd($penawarans);
        return view('penjualan.laporan.laporan-faktur',  [
            'faktur' => $fakturs,
            'bulan' => $bulan,
            'bulanangka' => $bulanangka,
            'tahun' => $tahun,
            'total' => $total,
        ]);
    }

    public function cetakfaktur(Request $request)
    {
        // dd($request);
        if($request->bulan_angka == 1){  $bulan = 'Januari';}
        if($request->bulan_angka == 2){  $bulan = 'Februari';}
        if($request->bulan_angka == 3){  $bulan = 'Maret';}
        if($request->bulan_angka == 4){  $bulan = 'April';}
        if($request->bulan_angka == 5){  $bulan = 'Mei';}
        if($request->bulan_angka == 6){  $bulan = 'Juni';}
        if($request->bulan_angka == 7){  $bulan = 'Juli';}
        if($request->bulan_angka == 8){  $bulan = 'Agustus';}
        if($request->bulan_angka == 9){  $bulan = 'September';}
        if($request->bulan_angka == 10){  $bulan = 'Oktober';}
        if($request->bulan_angka == 11){  $bulan = 'Novermber';}
        if($request->bulan_angka == 12){  $bulan = 'Desember';}

        $tahun = $request->tahun;
        // dd($request);
        $fakturs = Faktur::whereMonth('tanggal',$request->bulan_angka)
            ->whereYear('tanggal',$tahun)
            ->get();
        
            $total = 0;
            foreach ($fakturs as $faktur) {
                $total = $faktur->sum('total_harga');
               
            }

        $pdf = PDF::loadview('penjualan.laporan.cetak-laporan-faktur' ,  [
            'faktur' => $fakturs,
            'bulan' => $bulan,
            'tahun' => $tahun,
            'total' => $total,
        ]);

        return $pdf->download('laporan-faktur.pdf');
    }
    public function retur(Request $request)
    {
        $bulanangka = $request->bulan;
        if($request->bulan == 1){  $bulan = 'Januari';}
        if($request->bulan == 2){  $bulan = 'Februari';}
        if($request->bulan == 3){  $bulan = 'Maret';}
        if($request->bulan == 4){  $bulan = 'April';}
        if($request->bulan == 5){  $bulan = 'Mei';}
        if($request->bulan == 6){  $bulan = 'Juni';}
        if($request->bulan == 7){  $bulan = 'Juli';}
        if($request->bulan == 8){  $bulan = 'Agustus';}
        if($request->bulan == 9){  $bulan = 'September';}
        if($request->bulan == 10){  $bulan = 'Oktober';}
        if($request->bulan == 11){  $bulan = 'Novermber';}
        if($request->bulan == 12){  $bulan = 'Desember';}

        $tahun = $request->tahun;
        // dd($request);
        $returs = retur::whereMonth('tanggal',$request->bulan)
            ->whereYear('tanggal',$tahun)
            ->get();
            $total = 0;

            foreach ($returs as $retur) {
                $total = $retur->sum('total_harga');
               
            }
        // dd($penawarans);
        return view('penjualan.laporan.laporan-retur',  [
            'retur' => $returs,
            'bulan' => $bulan,
            'bulanangka' => $bulanangka,
            'tahun' => $tahun,
            'total' => $total,
        ]);
    }

    public function cetakretur(Request $request)
    {
        // dd($request);
        if($request->bulan_angka == 1){  $bulan = 'Januari';}
        if($request->bulan_angka == 2){  $bulan = 'Februari';}
        if($request->bulan_angka == 3){  $bulan = 'Maret';}
        if($request->bulan_angka == 4){  $bulan = 'April';}
        if($request->bulan_angka == 5){  $bulan = 'Mei';}
        if($request->bulan_angka == 6){  $bulan = 'Juni';}
        if($request->bulan_angka == 7){  $bulan = 'Juli';}
        if($request->bulan_angka == 8){  $bulan = 'Agustus';}
        if($request->bulan_angka == 9){  $bulan = 'September';}
        if($request->bulan_angka == 10){  $bulan = 'Oktober';}
        if($request->bulan_angka == 11){  $bulan = 'Novermber';}
        if($request->bulan_angka == 12){  $bulan = 'Desember';}

        $tahun = $request->tahun;
        // dd($request);
        $returs = retur::whereMonth('tanggal',$request->bulan_angka)
            ->whereYear('tanggal',$tahun)
            ->get();
        
            $total = 0;
            foreach ($returs as $retur) {
                $total = $retur->sum('total_harga');
               
            }

        $pdf = PDF::loadview('penjualan.laporan.cetak-laporan-retur' ,  [
            'retur' => $returs,
            'bulan' => $bulan,
            'tahun' => $tahun,
            'total' => $total,
        ]);

        return $pdf->download('laporan-retur.pdf');
    }

    public function pembayaran(Request $request)
    {
        $bulanangka = $request->bulan;
        if($request->bulan == 1){  $bulan = 'Januari';}
        if($request->bulan == 2){  $bulan = 'Februari';}
        if($request->bulan == 3){  $bulan = 'Maret';}
        if($request->bulan == 4){  $bulan = 'April';}
        if($request->bulan == 5){  $bulan = 'Mei';}
        if($request->bulan == 6){  $bulan = 'Juni';}
        if($request->bulan == 7){  $bulan = 'Juli';}
        if($request->bulan == 8){  $bulan = 'Agustus';}
        if($request->bulan == 9){  $bulan = 'September';}
        if($request->bulan == 10){  $bulan = 'Oktober';}
        if($request->bulan == 11){  $bulan = 'Novermber';}
        if($request->bulan == 12){  $bulan = 'Desember';}

        $tahun = $request->tahun;
        // dd($request);
        $pembayarans = pembayaran::whereMonth('tanggal',$request->bulan)
            ->whereYear('tanggal',$tahun)
            ->get();
            $total = 0;

            foreach ($pembayarans as $pembayaran) {
                $total = $pembayaran->sum('total');
               
            }
        // dd($penawarans);
        return view('penjualan.laporan.laporan-pembayaran',  [
            'pembayaran' => $pembayarans,
            'bulan' => $bulan,
            'bulanangka' => $bulanangka,
            'tahun' => $tahun,
            'total' => $total,
        ]);
    }

    public function cetakpembayaran(Request $request)
    {
        // dd($request);
        if($request->bulan_angka == 1){  $bulan = 'Januari';}
        if($request->bulan_angka == 2){  $bulan = 'Februari';}
        if($request->bulan_angka == 3){  $bulan = 'Maret';}
        if($request->bulan_angka == 4){  $bulan = 'April';}
        if($request->bulan_angka == 5){  $bulan = 'Mei';}
        if($request->bulan_angka == 6){  $bulan = 'Juni';}
        if($request->bulan_angka == 7){  $bulan = 'Juli';}
        if($request->bulan_angka == 8){  $bulan = 'Agustus';}
        if($request->bulan_angka == 9){  $bulan = 'September';}
        if($request->bulan_angka == 10){  $bulan = 'Oktober';}
        if($request->bulan_angka == 11){  $bulan = 'Novermber';}
        if($request->bulan_angka == 12){  $bulan = 'Desember';}

        $tahun = $request->tahun;
        // dd($request);
        $pembayarans = Pembayaran::whereMonth('tanggal',$request->bulan_angka)
            ->whereYear('tanggal',$tahun)
            ->get();
        
            $total = 0;
            foreach ($pembayarans as $pembayaran) {
                $total = $pembayaran->sum('total');
               
            }

        $pdf = PDF::loadview('penjualan.laporan.cetak-laporan-pembayaran' ,  [
            'pembayaran' => $pembayarans,
            'bulan' => $bulan,
            'tahun' => $tahun,
            'total' => $total,
        ]);

        return $pdf->download('laporan-pembayaran.pdf');
    }

    public function piutang(Request $request)
    {
        $id = $request->pelanggan_id;
        $pelanggan = Pelanggan::get()->where('id', $request->pelanggan_id);
        $piutangs = Piutang::get()->where('pelanggan_id', $request->pelanggan_id);
        $nama = $pelanggan[0]->nama_pelanggan;
        // dd($piutangs);
        $total = $piutangs->sum('total_piutang');
        $sisa = $piutangs->sum('sisa');
        $lunas = $piutangs->sum('lunas');

        // dd($lunas);
        return view('penjualan.laporan.laporan-piutang',  [
            'piutangs' => $piutangs,
            'nama' => $nama,
            'id' => $id,
            'sisa' => $sisa,
            'lunas' => $lunas,
            'total' => $total,
        ]);
    }

    public function cetakpiutang(Request $request)
    {
        $id = $request->pelanggan_id;
        $pelanggan = Pelanggan::get()->where('id', $request->pelanggan_id);
        $piutangs = Piutang::get()->where('pelanggan_id', $request->pelanggan_id);
        $nama = $pelanggan[0]->nama_pelanggan;
        // dd($piutangs);
        $total = $piutangs->sum('total_piutang');
        $sisa = $piutangs->sum('sisa');
        $lunas = $piutangs->sum('lunas');

        $pdf = PDF::loadview('penjualan.laporan.cetak-laporan-piutang' ,  [
            'piutangs' => $piutangs,
            'nama' => $nama,
            'id' => $id,
            'sisa' => $sisa,
            'lunas' => $lunas,
            'total' => $total,
        ]);

        return $pdf->download('laporan-piutang.pdf');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
