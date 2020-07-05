<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Pembelian\Pemasok;
use Faker\Generator as Faker;

$factory->define(Pemasok::class, function (Faker $faker) {
    return [
        'kode_pemasok'         => $faker->word,
        'nama_pemasok'         => $faker->name,
        'telp_pemasok'         => $faker->phoneNumber,
        'email_pemasok'        => $faker->unique()->safeEmail,
        'alamat_pemasok'       => $faker->address,
    ];
});
