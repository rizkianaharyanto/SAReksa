<?php

use Illuminate\Database\Seeder;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('stk_stok_gudang')->insert([
            'gudang_id' => '1',
            'barang_id'   => '1',
            'kuantitas'     => '0'
        ]);
        DB::table('stk_stok_gudang')->insert([
            'gudang_id' => '2',
            'barang_id'   => '1',
            'kuantitas'     => '30'
        ]);
        DB::table('stk_stok_gudang')->insert([
            'gudang_id' => '1',
            'barang_id'   => '2',
            'kuantitas'     => '0'
        ]);
        DB::table('stk_stok_gudang')->insert([
            'gudang_id' => '2',
            'barang_id'   => '2',
            'kuantitas'     => '50'
        ]);
        DB::table('stk_stok_gudang')->insert([
            'gudang_id' => '1',
            'barang_id'   => '3',
            'kuantitas'     => '0'
        ]);

        factory(App\Stock\Barang::class, 20)->create();
    }
}
