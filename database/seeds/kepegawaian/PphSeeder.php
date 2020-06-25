<?php

use Illuminate\Database\Seeder;

class PphSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('kpg_pphs')->insert([
            'batas_minimal'   => '0',
            'batas_maksimal'     => '50000000',
            'persentase' => '5'
        ]);
        DB::table('kpg_pphs')->insert([
            'batas_minimal'   => '50000000',
            'batas_maksimal'     => '250000000',
            'persentase' => '15'
        ]);
        DB::table('kpg_pphs')->insert([
            'batas_minimal'   => '250000000',
            'batas_maksimal'     => '500000000',
            'persentase' => '25'
        ]);
        DB::table('kpg_pphs')->insert([
            'batas_minimal'   => '500000000',
            'batas_maksimal'     => '50000000000',
            'persentase' => '30'
        ]);
    }
}
