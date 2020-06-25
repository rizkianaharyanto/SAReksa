<?php

use Illuminate\Database\Seeder;

class PtkpSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('kpg_ptkps')->insert([
            'status_ptkp'   => 'TK/0',
            'keterangan'     => 'Pria/Wanita Lajang Tidak ada tanggungan',
            'gaji_minimal' => '54000000'
        ]);
        DB::table('kpg_ptkps')->insert([
            'status_ptkp'   => 'TK/1',
            'keterangan'     => 'Pria/Wanita Lajang 1 tanggungan',
            'gaji_minimal' => '58500000'
        ]);
        DB::table('kpg_ptkps')->insert([
            'status_ptkp'   => 'TK/2',
            'keterangan'     => 'Pria/Wanita Lajang 2 tanggungan',
            'gaji_minimal' => '63000000'
        ]);
        DB::table('kpg_ptkps')->insert([
            'status_ptkp'   => 'TK/3',
            'keterangan'     => 'Pria/Wanita Lajang 3 tanggungan',
            'gaji_minimal' => '67500000'
        ]);
        DB::table('kpg_ptkps')->insert([
            'status_ptkp'   => 'K/0',
            'keterangan'     => 'Pria/Wanita kawin tidak ada tanggungan',
            'gaji_minimal' => '58500000'
        ]);
        DB::table('kpg_ptkps')->insert([
            'status_ptkp'   => 'K/1',
            'keterangan'     => 'Pria/Wanita kawin 1 tanggungan',
            'gaji_minimal' => '63000000'
        ]);
        DB::table('kpg_ptkps')->insert([
            'status_ptkp'   => 'K/2',
            'keterangan'     => 'Pria/Wanita kawin 2 tanggungan',
            'gaji_minimal' => '67500000'
        ]);
        DB::table('kpg_ptkps')->insert([
            'status_ptkp'   => 'K/3',
            'keterangan'     => 'Pria/Wanita kawin 3 tanggungan',
            'gaji_minimal' => '72000000'
        ]);

        
    }
}
