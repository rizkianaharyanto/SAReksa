<?php

namespace App\Services\Stock;

use App\Stock\Barang;
use Carbon\Carbon;
use App\ItemPurchaseTransaction;

class CogsCalculationService
{
    public function FIFO($itemData, $stocks)
    {
        // return $stocks;
        if ($stocks > 0) {
            return $itemData->nilai_barang;
        } elseif ($stocks <= 0) {
            return $itemData->pivot->harga_beli;
        } else {
            return "failed";
        }
    }

    public function LIFO($itemData)
    {
        return $itemData->pivot->harga_beli;
    }
    public function average($purchTrans, $itemData, $stocks)
    {
        $jumlah =  ($itemData->pivot->harga_beli * $itemData->pivot->quantity) + ($itemData->nilai_barang * $stocks);
        $total = $itemData->pivot->quantity + $stocks;
        $avg =  $jumlah/$total;
        return $avg;
    }
}
