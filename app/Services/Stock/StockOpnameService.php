<?php
namespace App\Services\Stock;

use App\Stock\StokOpname;
use App\Repositories\Stock\Repository;

class StockOpnameService
{
    private $stockOp;
    public function __construct(StokOpname $stockop)
    {
        $this->stockOp = new Repository($stockop);
    }
    public function makeTransJournal($data)
    {
        return $this->stockOp->create($data->toArray())->id;
    }

    public function get($id)
    {
        return StokOpname::with([
            'details',
            'gudang'
        ])->find($id);
    }

    public function editTrans($data, $id)
    {
    }
}
