<?php

namespace App\Http\Controllers\Stock;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Stock\Repository;
use App\Stock\Gudang;
use App\Http\Requests\Stock\WarehouseRequest;

class WarehouseController extends Controller
{
    protected $model;
    public function __construct(Gudang $wh)
    {
        $this->model = new Repository($wh);
    }
    public function index()
    {
        //
      
        $allData = $this->model->all();
        return view('stock.management-data/gudang', compact("allData"));
    }

    public function indexpembelian()
    {
        $allData = $this->model->all();
        return view('pembelian.manajemendata.gudang', compact("allData"));
    }

    public function indexpenjualan()
    {
        $allData = $this->model->all();
        return view('penjualan.manajemendata.gudang', compact("allData"));
    }

    public function store(WarehouseRequest $request)
    {
        $input = $request->validated();
        $data= $this->model->create($input);
        return redirect()->back();
    }

    public function show($id)
    {
        //
    }
    public function update(Request $request, $id)
    {
        //
        $input = $request->only($this->model->getModel()->fillable);
       
        return redirect()->back();
    }

    public function destroy($id)
    {
        //
        $this->model->delete($id);
        return "Success";
    }
}
