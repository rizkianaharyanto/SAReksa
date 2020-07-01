<?php

namespace App\Http\Controllers\Penjualan;

use App\Penjualan\Pelanggan;
use Illuminate\Http\Request;
use Illuminate\View\ViewName;
use App\Http\Controllers\Controller;


class PelanggansController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pelanggans = Pelanggan::all();
        // dd($pealnggans);
        return view('penjualan.manajemendata.pelanggan', [
            'pelanggans' => $pelanggans,
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        session()->flash('message', 'Pelanggan berhasil ditambahkan');
        session()->flash('status', 'tambah');
        $sup = Pelanggan::max('id') + 1;
        $pelanggan = Pelanggan::create([
            'kode_pelanggan' => 'PEL-'.$sup,
            'nama_pelanggan' => $request->nama_pelanggan,
            'telp_pelanggan' => $request->telp_pelanggan,
            'email_pelanggan' => $request->email_pelanggan,
            'alamat_pelanggan' => $request->alamat_pelanggan,
        ]);

        return redirect('/penjualan/pelanggans');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Pelanggan  $pelanggan
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pelanggan = Pelanggan::find($id);
        $penawarans = $pelanggan->penawarans;
        $pemesanans = $pelanggan->pemesanans;
        $pengirimans = $pelanggan->pengirimans;
        $fakturs = $pelanggan->fakturs;
        $piutangs = $pelanggan->piutangs;
        $piutangmasih = array();
        $pemesananpengiriman = array();
        $pemesananfaktur = array();
        $pengirimanfaktur = array();
        $fakturretur = array();
        $fakturet = $pelanggan->fakturs()->where('status', 'piutang')->where('status_posting', 'sudah posting')->get();

        // dd($fakturet);
        $i=0;
        foreach($piutangs as $piutangs){
            if($piutangs->status == 'piutang'){
                $piutangmasih[$i] = $piutangs;
                $i++;
            }
        }
        
        $k=0;

        $j=0;
        foreach($pemesanans as $pemesanans){
            if($pemesanans->status == 'baru' || $pemesanans->status == 'terkirim sebagian'){
                $pemesananpengiriman[$j] = $pemesanans;
                $j++;
            }
            if($pemesanans->status == 'baru'){
                $pemesananfaktur[$k] = $pemesanans;
                $k++;
            }
        }
        $l=0;
        foreach($pengirimans as $pengirimans){
            if($pengirimans->status == 'sudah posting'){
                $pengirimanfaktur[$l] = $pengirimans;
                $l++;
            }
        }
        $idr = array();
        $m=0;
        $z=0;
        foreach($pelanggan->returs as $returan){
            $idr[$z] = $returan->faktur_id;
            $z++;
        }
        // dd($idr);
        $z=0;
        foreach($fakturs as $fakturs){
            if($fakturs->status_posting == 'sudah posting'){
                if($idr){
                    foreach($idr as $idrs){
                        if($fakturs->id != $idrs){
                            $fakturretur[$m] = $fakturs;
                            $m++;                    
                        }                    
                    }
                }
                else{
                    $fakturretur[$m] = $fakturs;
                            $m++; 
                }
                // if($idr){
                //     foreach($idr as $idr){
                //         if($fakturs->id != $idr){
                //             $fakturretur[$m] = $fakturs;
                //             $m++;
                //         }
                //     }
                // }
                // else{
                //     $fakturretur[$m] = $fakturs;
                // $m++;
                // }
                
            }
        }
        
        // for ($i = 0 ; $i < count($piutang) ; i++) {
        //     if ($piutang[i]->total_piutang != 0){
        //         $piutangmasih[i] = $piutang[i];
        //     }
        // }

        return response()
        ->json([
            'pelanggan' => $pelanggan, 
            'penawarans' => $penawarans, 
            'pemesanans' => $pemesananpengiriman, 
            'pemesananfakturs' => $pemesananfaktur,
            'pengirimanfakturs' => $pengirimanfaktur,  
            'pengirimans'=> $pengirimans,
            'fakturs'=> $fakturs,
            'fakturet'=> $fakturet,
            'fakturreturs' => $fakturretur,
            'piutangs' => $piutangmasih,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Pelanggan  $pelanggan
     * @return \Illuminate\Http\Response
     */
    public function edit(Pelanggan $pelanggan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Pelanggan  $pelanggan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pelanggan $pelanggan)
    {
        
        session()->flash('message', 'Pelanggan berhasil diubah');
        session()->flash('status', 'tambah');
        Pelanggan::where('id', $pelanggan->id)
            ->update([
                'nama_pelanggan' => $request->nama_pelanggan,
                'telp_pelanggan' => $request->telp_pelanggan,
                'email_pelanggan' => $request->email_pelanggan,
                'alamat_pelanggan' => $request->alamat_pelanggan
            ]);

        return redirect('/penjualan/pelanggans');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Pelanggan  $pelanggan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pelanggan $pelanggan)
    {
        session()->flash('message', 'Pelanggan berhasil dihapus');
        session()->flash('status', 'hapus');
        Pelanggan::destroy($pelanggan->id);
        return redirect('/penjualan/pelanggans');
        // return $pelanggan;
    }
}
