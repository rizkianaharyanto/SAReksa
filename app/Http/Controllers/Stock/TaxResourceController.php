<?php

namespace App\Http\Controllers\Stock;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Stock\Repository;
use App\Stock\PajakBarang;
use App\Http\Requests\Stock\CreateTaxRequest;

class TaxResourceController extends Controller
{
    //

    protected $model;
    public function __construct(PajakBarang $tax)
    {
        $this->model = new Repository($tax);
    }
    public function index()
    {
        //
      
        $allData = $this->model->all();
        return view('stock.management-data.pajak', compact("allData"));
    }
    public function indexpembelian()
    {
        //
      
        $allData = $this->model->all();
        // return $allData;
        return view('pembelian.manajemendata.pajak', compact("allData"));
    }
    public function indexpenjualan()
    {
        //
      
        $allData = $this->model->all();
        // return $allData;
        return view('penjualan.manajemendata.pajak', compact("allData"));
    }
    public function store(CreateTaxRequest $request)
    {
        $input = $request->input();
        $input['tarif'] = $input['tarif']/100;
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
        $input['tarif'] = $input['tarif']/100;

        $this->model->update($input, $id);
        
        return redirect()->back();
    }

    public function destroy($id)
    {
        //
        $this->model->delete($id);
        return redirect()->back();
    }
}
