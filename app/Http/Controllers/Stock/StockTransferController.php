<?php

namespace App\Http\Controllers\Stock;

use App\Http\Controllers\Controller;
use App\Stock\TransferStok;
use Illuminate\Http\Request;
use App\Services\Stock\StockTransferService;
use App\Http\Requests\Stock\CreateStockTransferRequest;

class StockTransferController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(StockTransferService $stockTf)
    {
        //
        $allData = $stockTf->all();
        return view('transfer-stock', compact($allData));
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
        return $stockTf->make($input);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\StockTransfer  $stockTransfer
     * @return \Illuminate\Http\Response
     */
    public function show(StockTransfer $stockTransfer)
    {
        //
    }

  
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\StockTransfer  $stockTransfer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, StockTransfer $stockTransfer)
    {
        //
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
