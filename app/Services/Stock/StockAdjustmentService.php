<?php
namespace App\Services\Stock;

use Illuminate\Support\Collection;
use App\Stock\PenyesuaianStok;

class StockAdjustmentService
{
    public function all()
    {
        $stockAdjustments = PenyesuaianStok::with([
            'details',
            'gudang',
        ])->get();
        return $stockAdjustments;
    }
}
