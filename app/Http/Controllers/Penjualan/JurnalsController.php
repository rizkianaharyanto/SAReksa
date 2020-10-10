<?php

namespace App\Http\Controllers\Penjualan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Penjualan\Jurnal;
use PDF;


class JurnalsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jurnals = Jurnal::all()->groupBy('kode_jurnal');
        $debit = 0;
        $kredit = 0;
        foreach (Jurnal::all() as $jurnal){
            $debit += $jurnal->debit;
            $kredit += $jurnal->kredit;
        }
        // dd($debit, $kredit);
        // dd($jurnals);
        return view('penjualan.jurnal', [
            'jurnals' => $jurnals,
            'debit' => $debit,
            'kredit' => $kredit
        ]);
    }

    public function filter(Request $request)
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
        $jurnals = Jurnal::whereMonth('tanggal',$request->bulan)
        ->whereYear('tanggal',$request->tahun)->get()->groupBy('kode_jurnal');
        // dd($jurnals);
        $debit = 0;
        $kredit = 0;
        foreach ( Jurnal::whereMonth('tanggal',$request->bulan)
        ->whereYear('tanggal',$request->tahun)->get() as $jurnal){
            $debit += $jurnal->debit;
            $kredit += $jurnal->kredit;
        }
        // dd($debit, $kredit);
        // dd($jurnals);
        return view('penjualan.jurnal', [
            'jurnals' => $jurnals,
            'debit' => $debit,
            'bulan' => $bulan,
            'bulanangka' => $bulanangka,
            'tahun' => $request->tahun,
            'periode' => 'Periode',
            'kredit' => $kredit
        ]);
    }

    public function cetak_filter(Request $request)
    {
        // dd($request);
        $bulanangka = $request->bulan;
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
        $jurnals = Jurnal::whereMonth('tanggal',$request->bulan_angka)
        ->whereYear('tanggal',$request->tahun)->get()->groupBy('kode_jurnal');
        // dd($jurnals);
        $debit = 0;
        $kredit = 0;
        foreach ( Jurnal::whereMonth('tanggal',$request->bulan_angka)
        ->whereYear('tanggal',$request->tahun)->get() as $jurnal){
            $debit += $jurnal->debit;
            $kredit += $jurnal->kredit;
        }
        $pdf = PDF::loadview('penjualan.jurnal-pdf', [
            'jurnals' => $jurnals,
            'debit' => $debit,
            'bulan' => $bulan,
            'bulanangka' => $bulanangka,
            'tahun' => $request->tahun,
            'periode' => 'Periode',
            'kredit' => $kredit
            ]);
        return $pdf->download('penjualan.jurnal-pdf.pdf');
    }

    public function cetak_pdf()
    {
        $jurnals = Jurnal::all()->groupBy('kode_jurnal');
        $debit = 0;
        $kredit = 0;
        foreach (Jurnal::all() as $jurnal){
            $debit += $jurnal->debit;
            $kredit += $jurnal->kredit;
        }
        $pdf = PDF::loadview('penjualan.jurnal-pdf', [
            'jurnals' => $jurnals,
            'debit' => $debit,
            'kredit' => $kredit
        ]);

        return $pdf->download('penjualan.jurnal-pdf.pdf');
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
