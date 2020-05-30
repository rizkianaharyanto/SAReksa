<?php

namespace App\Http\Controllers\Stock;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Stock\Repository;
use App\Stock\SatuanUnit;
use App\Http\Requests\Stock\CreateSatuanUnitRequest;

class UnitsResourceController extends Controller
{
    /**
      * Display a listing of the resource.
      *
      * @return \Illuminate\Http\Response
      */
    protected $model;
    public function __construct(SatuanUnit $unit)
    {
        $this->model = new Repository($unit);
    }
    public function index()
    {
        //
      
        $allUnits = $this->model->all();
        return view('stock.Management-Data/satuan-unit', compact("allUnits"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function create()
    // {
    //     //
    //     $
    //     return view('create_item_ctg');
    // }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateSatuanUnitRequest $request)
    {
        //

        $input = $request->validated();
        $data = $this->model->create($input);
        return redirect()->back();
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $input = $request->only($this->model->getModel()->fillable);
        $this->model->update($input, $id);

        return redirect()->back();
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
        $itc = $this->model->delete($id);
        return "Success";
    }
}
