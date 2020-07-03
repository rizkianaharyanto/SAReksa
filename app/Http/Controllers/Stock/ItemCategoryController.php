<?php

namespace App\Http\Controllers\Stock;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Stock\Repository;
use App\Stock\KategoriBarang;
use App\Http\Requests\Stock\ItemCategoryRequest;

class ItemCategoryController extends Controller
{
    protected $model;
    public function __construct(KategoriBarang $itemctg)
    {
        $this->model = new Repository($itemctg);
    }
    public function index()
    {
        //
       
        $allData = $this->model->all();
        // dd($allData);
        return view('stock.management-data.kategori-barang', compact("allData"));
    }
    public function store(ItemCategoryRequest $request)
    {
        // dd($request);
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
        return redirect()->back();
    }
}
