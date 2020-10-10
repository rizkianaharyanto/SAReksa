<?php

namespace App\Http\Controllers\Kepegawaian;
use App\Http\Controllers\Controller;
use App\Kepegawaian\Penggajian;
use App\Kepegawaian\Pegawai;
use App\Kepegawaian\Ptkp;
use App\Kepegawaian\Pph;
use App\Kepegawaian\Tunjangan;

use Illuminate\Http\Request;

class PenggajianController extends Controller
{
    //
    public function index(Request $request){
        $penggajians = Penggajian::orderBy('tanggal', 'desc')->where('status',0)->get();
        $request->session()->put('page','penggajian');
        $request->session()->put('title','Penggajian');
        return view('kepegawaian.penggajian',compact('penggajians'));
    }


    public function store(Request $request)
    {
        $jumlah = 0;
        $status = 0;

        foreach($request->jumlah_tunjangan as $tunjangan ){
            $jumlah = $tunjangan + $jumlah;
        }

        $gaji = $jumlah;
        $pajak = 0;

        // cek ptkp
        $pegawai = Pegawai::find($request->pegawai_id);
        $ptkp_id = $pegawai->ptkp;
        $ptkp = Ptkp::find($ptkp_id);
        $gaji_minimal = $ptkp->gaji_minimal;

        // cek pph
        if($gaji_minimal <= $jumlah*12){

            $kena_pajak = $jumlah * 12 - $gaji_minimal;

            $pphs = Pph::orderBy('batas_minimal', 'asc')->get();
            
            foreach($pphs as $pph){
                if( $pph->batas_minimal <= $kena_pajak && $pph->batas_maksimal >= $kena_pajak){
                    $persentase = $pph->persentase;
                }
            }
            $pajak = ($kena_pajak*($persentase/100))/12;
            $gaji = $gaji - $pajak; 
        }

        Penggajian::create([
            'pegawai_id' => $request->pegawai_id,
            'tanggal' => $request->tanggal,
            'jumlah' => $jumlah,
            'gaji' => $gaji,
            'pajak' => $pajak,
            'status' => $status,
        ]);
        $penggajian = Penggajian::latest()->first();
        foreach($request->tunjangan_id as $index => $id ){
            $penggajian->tunjangan()->attach($id,['jumlah_tunjangan'=>$request->jumlah_tunjangan[$index]]);
        }
        

        return redirect('kepegawaian/penggajian')->with('status','Tambah penggajian berhasil');
    }

    public function tambah(Request $request){
        $pegawais = Pegawai::orderBy('nama', 'asc')->get();
        $tunjangans = Tunjangan::orderBy('nama_tunjangan', 'asc')->get();
        $request->session()->put('title','Penggajian - Tambah');
        return view('kepegawaian.penggajian.tambah', compact('tunjangans','pegawais'));
    }

    public function terima($id){

        $penggajian = Penggajian::find($id);
        $penggajian->status = '1';
        $penggajian->save();

        return redirect('kepegawaian/penggajian')->with('status','Setujui penggajian pegawai berhasil');

    }

    public function tolak($id){


        $penggajian = Penggajian::find($id);
        $penggajian->status = '2';
        $penggajian->save();

        return redirect('kepegawaian/penggajian')->with('status','Hapus penggajian pegawai berhasil');

    }

    public function ditolak(Request $request){


        $penggajians = Penggajian::orderBy('tanggal', 'desc')->where('status', 2)->get();
        $request->session()->put('page','dihapus');
        $request->session()->put('title','Penggajian - Daftar dihapus');

        return view('kepegawaian.penggajian.ditolak',compact('penggajians'));

    }

    public function show(Penggajian $penggajian, Request $request)
    {
        //
        $pegawais = Pegawai::orderBy('nama', 'asc')->get();
        $tunjangans = Tunjangan::orderBy('nama_tunjangan', 'asc')->get();
        $request->session()->put('title','Penggajian - ubah');
        return view('kepegawaian.penggajian.ubah',compact('penggajian','pegawais','tunjangans'));
    }


    public function update(Request $request, $id)
    {
        //
        $jumlah = 0;
        $status = 0;

        foreach($request->jumlah_tunjangan as $tunjangan ){
            $jumlah = $tunjangan + $jumlah;
        }

        $gaji = $jumlah;
        $pajak = 0;

        // cek ptkp
        $pegawai = Pegawai::find($request->pegawai_id);
        $ptkp_id = $pegawai->ptkp;
        $ptkp = Ptkp::find($ptkp_id);
        $gaji_minimal = $ptkp->gaji_minimal;

        // cek pph
        if($gaji_minimal <= $jumlah*12){

            $kena_pajak = $jumlah * 12 - $gaji_minimal;

            $pphs = Pph::orderBy('batas_minimal', 'asc')->get();
            
            foreach($pphs as $pph){
                if( $pph->batas_minimal <= $kena_pajak && $pph->batas_maksimal >= $kena_pajak){
                    $persentase = $pph->persentase;
                }
            }
            $pajak = ($kena_pajak*($persentase/100))/12;
            $gaji = $gaji - $pajak; 
        }

        Penggajian::where('id',$id)
        ->update([
            'pegawai_id' => $request->pegawai_id,
            'tanggal' => $request->tanggal,
            'jumlah' => $jumlah,
            'gaji' => $gaji,
            'pajak' => $pajak,
            'status' => $status,
        ]);

        $penggajian = Penggajian::find($id);
        $penggajian->tunjangan()->detach();

        foreach($request->tunjangan_id as $index => $id ){
            $penggajian->tunjangan()->attach($id,['jumlah_tunjangan'=>$request->jumlah_tunjangan[$index]]);
        }
        return redirect('kepegawaian/penggajian')->with('status','Ubah penggajian berhasil');
        
    }
}
