<?php

use Illuminate\Database\Seeder;

class UnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('stk_satuan_unit')->insert([
            'kode_satuan' => 'BX',
            'nama_satuan' => 'Box'
        ]);
        DB::table('stk_satuan_unit')->insert([
            'kode_satuan' => 'PCS',
            'nama_satuan' => 'Pieces'
        ]);
        DB::table('stk_satuan_unit')->insert([
            'kode_satuan' => 'PCKG',
            'nama_satuan' => 'Packages'
        ]);
        DB::table('stk_satuan_unit')->insert([
            'kode_satuan' => 'CUP',
            'nama_satuan' => 'Cups'
        ]);
    }
}
