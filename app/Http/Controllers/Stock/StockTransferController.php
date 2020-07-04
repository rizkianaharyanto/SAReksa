<?php

namespace App\Http\Controllers\Stock;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Stock\StockTransferService;
use App\Http\Requests\Stock\CreateStockTransferRequest;
use App\Stock\TransferStok;
use App\Stock\Gudang;
use App\Stock\Barang;

class StockTransferController extends Controller
{
    private $service;
    
    public function __construct(StockTransferService $service)
    {
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(StockTransferService $stockTf)
    {
        //
        $allData = $stockTf->all();
        $gudangs = Gudang::all();
        $barangs = Barang::all();
        return view('stock.transactions.transfer-stock.index', [
            'allData' => $allData,
            'gudangs' => $gudangs,
            'barangs' => $barangs
            ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    

    public function posting()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StockTransferService $stockTf, CreateStockTransferRequest $req)
    {
        //
        $input = $req->validated();
        $stockTf->make($input);
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\StockTransfer  $stockTransfer
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $transferStock = $this->service->get($id);
        if (!$transferStock) {
            return redirect('/stok/transfer-stock')->with('status', 'Data Transaksi tersebut tidak ditemukan');
        }
        return view('stock.transactions.transfer-stock.details', compact('transferStock'));
    }

  
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\StockTransfer  $stockTransfer
     * @return \Illuminate\Http\Response
     */
    public function update(CreateStockTransferRequest $request, $id)
    {
        return $this->service->update($request->validated(), $id);
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\StockTransfer  $stockTransfer
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $this->model->delete($id);
        return "Success";
    }
}
