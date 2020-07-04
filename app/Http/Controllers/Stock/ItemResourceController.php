<?php

namespace App\Http\Controllers\Stock;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Stock\ItemService;
use App\Http\Requests\Stock\CreateItemsRequest;
use App\Stock\Barang;
use App\Stock\KategoriBarang;
use App\Stock\SatuanUnit;
use App\Stock\Gudang;

class ItemResourceController extends Controller
{
    private $service;
    public function __construct(ItemService $service)
    {
        $this->service = $service;
    }
    public function index(ItemService $item)
    {
        // $allItem = $item->all();
        $allItem = Barang::with([
            'unit:id,nama_satuan',
            'kategori'
            ])->get();
            
        $categories = KategoriBarang::all();
        $units = SatuanUnit::all();
        $gudangs = Gudang::all();
        return view('stock.management-data/barang', [
            'barang'=>$allItem,
            'kategoriBarang' => $categories,
            'satuanUnit' => $units,
            'gudangs' => $gudangs
            ]);
    }
    
    public function indexpenjualan(ItemService $itmSrv)
    {
        $allDataBarang = $itmSrv->getAllStocksQty();
        return view('penjualan.manajemendata.barang', ['data' => $allDataBarang]);
    }

    public function indexpembelian(ItemService $itmSrv)
    {
        $allDataBarang = $itmSrv->getAllStocksQty();
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
         
        return redirect()->back();
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

    public function getStocksByWarehouse($warehouseId)
    {
        $stocks = $this->service->getAllStocksByWhouse($warehouseId);
        return $stocks;
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
        $this->service->delete($id);
        return redirect()->back();
    }
}
