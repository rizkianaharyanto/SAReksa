<?php

use Illuminate\Database\Seeder;

class TaxSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('stk_pajak_master')->insert([
        'jenis_pajak' => 'PPN',
        'tarif' => '0.01'
    ]);
        DB::table('stk_pajak_master')->insert([
        'jenis_pajak' => 'pph',
        'tarif' => '0.1'
    ]);
    }
}
