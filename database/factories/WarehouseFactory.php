<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Stock\Gudang;
use Faker\Generator as Faker;

$factory->define(Gudang::class, function (Faker $faker) {
    return [
        'kode_gudang' => $faker->word,
        'alamat'      => $faker->address,
        'no_telp'     => $faker->phoneNumber,
        'status'      => 'aktif',
        //
    ];
});
