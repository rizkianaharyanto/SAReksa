<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Stock\Barang;
use Faker\Generator as Faker;

$factory->define(Barang::class, function (Faker $faker) {
    return [
        'kode_barang'       => $faker->lexify('001-???'),
        'kategori_barang'   => $faker->numberBetween($min=1, $max=3),
        'nama_barang'       => $faker->word,
        'satuan_unit'       => $faker->numberBetween($min=1, $max = 4),
        'item_image'        => $faker->imageUrl($width =200, $height=200),
        'akun_hpp'          => $faker->numerify('1###'),
        'akun_persediaan'   => $faker->numerify('2###'),
        'akun_penjualan'    => $faker->numerify('3###'),
        'nilai_barang'      => $faker->numberBetween($min= 10000, $max = 100000),
        'akun_pembelian'    => $faker->numerify('4###'),
        'pajak_id'          => $faker->numberBetween($min = 1, $max = 3),
        'supplier_id'       => $faker->numberBetween($min = 1, $max = 10),
       
        

    ];
});
