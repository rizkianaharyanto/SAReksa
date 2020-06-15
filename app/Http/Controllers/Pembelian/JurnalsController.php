<?php

namespace App\Http\Controllers\Pembelian;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Pembelian\Jurnal;
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
        // dd($jurnals['jur'][0]);
        return view('pembelian.jurnal', compact('jurnals'));
    }

    public function cetak_pdf($debit, $kredit)
    {
        $jurnals = Jurnal::all()->groupBy('kode_jurnal');
        $debit = $debit;
        $kredit = $kredit;
        $pdf = PDF::loadview('pembelian.jurnal-pdf', ['jurnals' => $jurnals, 'debit' => $debit, 'kredit' => $kredit]);

        return $pdf->download('pembelian.jurnal-pdf.pdf');
        // return view('pembelian.jurnal-pdf', ['jurnals' => $jurnals]);
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
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int                      $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    }
}
