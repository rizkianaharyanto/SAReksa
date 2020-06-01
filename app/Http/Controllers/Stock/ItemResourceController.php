<?php

namespace App\Http\Controllers\Stock;

use App\Http\Controllers\Controller;
use App\Stock\Barang;
use Illuminate\Http\Request;
use App\Services\Stock\ItemService;
use App\Http\Requests\Stock\CreateItemsRequest;

class ItemResourceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(ItemService $item)
    {
        // $allItem = $item->all();
        $allItem = Barang::with('unit:id,nama_satuan')->get();
        return view('stock.Management-Data/barang', ['data'=>$allItem]);
    }
    
    public function indexpembelian(ItemService $itmSrv)
    {
        // $b = Barang::with('warehouseStocks:stk_stok_gudang.id,kuantitas')->get();
        // $c = $b->map(function ($item, $key) {
        //     $this->total = 0;
        //     $d = $item->warehouseStocks->map(function ($item, $key) {
        //         $this->total += $item->kuantitas;
        //         $item->total = $this->total;
        //         return $item->total;
        //     })->toArray();
        //     return(end($d));
        // })->toArray();
        // return view('pembelian.manajemendata.barang', ['data'=>$b, 'stok'=>$c]);
        $allDataBarang = $itmSrv->getAllStocksQty();
        // dd($allDataBarang);
        return view('pembelian.manajemendata.barang', ['data' => $allDataBarang]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
  
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ItemService $itemService, CreateItemsRequest $request)
    {
        //
        $input = $request->validated();

        $item = $itemService->create($input);
         
        return redirect()->back()->withSuccess($message);
    }

    public function test(ItemService $itmSrv)
    {
        $allDataBarang = $itmSrv->getAllStocksQty();
        dd($allDataBarang);
    }

    /**p
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $barang = Barang::with('unit:id,nama_satuan')->find($id);
        return $barang;
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
        $itc = $this->modelName::find($id);
        $itc->delete();
        return "Success";
    }
}
