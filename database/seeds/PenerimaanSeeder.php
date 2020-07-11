<?php

use Illuminate\Database\Seeder;
use App\Pembelian\Penerimaan;
use Carbon\Carbon;

class PenerimaanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Penerimaan::create([
            'kode_penerimaan' => 'PNM-001',
            'tanggal'         => Carbon::parse('23-03-2000'),
            'gudang'          => "Gudang Warehouse",
            'total_jenis_barang' => 3,
            'total_harga'       => 20000,
            'diskon'        => 0.02,
            'biaya_lain'        => 2000,
            'created_at'    => now(),
            'updated_at'    => now(),
            'pemasok_id'    => 1,
            'pemesanan_id'  => 1,
        ]);

        DB::table('pbl_penerimaan_details')->insert([
            'unit' => "box",
            
        ]);
    }
}
