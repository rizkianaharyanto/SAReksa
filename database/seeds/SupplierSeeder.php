<?php

use Illuminate\Database\Seeder;
use App\Pembelian\Pemasok;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Pemasok::class, 10)->create();
    }
}
