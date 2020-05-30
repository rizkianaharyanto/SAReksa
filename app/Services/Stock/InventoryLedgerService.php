<?php
namespace App\Services\Stock;

use App\Stock\JurnalStok;
use App\Repositories\Stock\Repository;

class InventoryLedgerService
{
    public function posting($items, $debitAaccount, $creditAccount)
    {
        // $data = $data->first();
        //Blum dikali harga barang
        // if ref == stock opnamee
        $diff = $items['pivot']['jumlah_tercatat']  - $items['pivot']['jumlah_fisik'];
        if ($diff > 0) {
            $debit = $diff;
            $kredit  = $diff * -1;
        } else {
            $debit = $diff * -1;
            $kredit = $diff;
        }
       

       


        //end elif
        $ledger = [
            'kode_ref'        => 'AABBC',
            'akun_debit'      => $debitAaccount,
            'akun_kredit'     => $creditAccount,
            'units'           => $items['satuan_unit'],
            'debit'           => $debit,
            'kredit'          => $kredit,

        ];

        return JurnalStok::create($ledger);
    }
}
