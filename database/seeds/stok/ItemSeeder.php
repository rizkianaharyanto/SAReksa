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
        DB::table('stk_kategori_barang')->insert([
            'kode_kategori'       => 'BAHAN-POKOK',
            'nama_kategori'       => 'Bahan Pokok'
        ]);

        DB::table('stk_kategori_barang')->insert([
            'kode_kategori'       => 'ATK',
            'nama_kategori'       => 'Alat Tulis Kantor'
        ]);
        DB::table('stk_kategori_barang')->insert([
            'kode_kategori'       => 'BABY',
            'nama_kategori'       => 'Perlengkapan Bayi'
        ]);
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
        DB::table('stk_harga_retail_history')->insert([
            'harga_retail'   => '10000',
            'item_id'        => '3',
            'created_at'     => now(),
            'updated_at'     => now()
        ]);
        DB::table('stk_harga_grosir_history')->insert([
            'harga_grosir'   => '10000',
            'item_id'        => '3',
            'created_at'     => now(),
            'updated_at'     => now()
        ]);

        factory(App\Stock\Barang::class, 20)->create();
    }
}
