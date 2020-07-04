<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\User;
use Carbon\Carbon;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name'      => "mahardika23",
            'email'     => "test@gmail.com",
            "password"  => Hash::make('test'),
            "role_id"   => '1'
        ]);
        User::create([
            'name'      => "ana",
            'email'     => "test2@gmail.com",
            "password"  => Hash::make('test'),
            "role_id"   => '2'
        ]);
        User::create([
            'name'      => "Admin Pembelian",
            'email'     => "pembelian@gmail.com",
            "password"  => Hash::make('test'),
            "role_id"   => '3'
        ]);
        User::create([
            'name'      => "Admin Retur",
            'email'     => "retur@gmail.com",
            "password"  => Hash::make('test'),
            "role_id"   => '4'
        ]);
        User::create([
            'name'      => "Admin Hutang",
            'email'     => "hutang@gmail.com",
            "password"  => Hash::make('test'),
            "role_id"   => '5'
        ]);
        User::create([
            'name'      => "Direksi Perusahaan",
            'email'     => "direksi@gmail.com",
            "password"  => Hash::make('test'),
            "role_id"   => '6'
        ]);

        DB::table('roles')->insert([
            'role_name'     => 'Operator Gudang',
            'departemen'    => 'stok',
            'created_at'    => Carbon::now('WIB'),
            'updated_at'    => Carbon::now('WIB')
        ]);
        DB::table('roles')->insert([
            'role_name'     => 'Admin Gudang',
            'departemen'    => 'stok',
            'created_at'    => Carbon::now('WIB'),
            'updated_at'    => Carbon::now('WIB')
        ]);
        DB::table('roles')->insert([
            'role_name'     => 'Admin Pembelian',
            'departemen'    => 'pembelian',
            'created_at'    => Carbon::now('WIB'),
            'updated_at'    => Carbon::now('WIB')
        ]);
        DB::table('roles')->insert([
            'role_name'     => 'Admin Retur Pembelian',
            'departemen'    => 'pembelian',
            'created_at'    => Carbon::now('WIB'),
            'updated_at'    => Carbon::now('WIB')
        ]);
        DB::table('roles')->insert([
            'role_name'     => 'Admin Utang',
            'departemen'    => 'pembelian',
            'created_at'    => Carbon::now('WIB'),
            'updated_at'    => Carbon::now('WIB')
        ]);
        DB::table('roles')->insert([
            'role_name'     => 'Direksi Perusahaan',
            'departemen'    => 'pembelian',
            'created_at'    => Carbon::now('WIB'),
            'updated_at'    => Carbon::now('WIB')
            ]);
        DB::table('roles')->insert([
            'role_name'     => 'penjualan',
            'departemen'    => 'penjualan',
            'created_at'    => Carbon::now('WIB'),
            'updated_at'    => Carbon::now('WIB')
        ]);
        DB::table('roles')->insert([
            'role_name'     => 'retur',
            'departemen'    => 'penjualan',
            'created_at'    => Carbon::now('WIB'),
            'updated_at'    => Carbon::now('WIB')
        ]);
        DB::table('roles')->insert([
            'role_name'     => 'piutang',
            'departemen'    => 'penjualan',
            'created_at'    => Carbon::now('WIB'),
            'updated_at'    => Carbon::now('WIB')
        ]);
        DB::table('roles')->insert([
            'role_name'     => 'direksi',
            'departemen'    => 'penjualan',
            'created_at'    => Carbon::now('WIB'),
            'updated_at'    => Carbon::now('WIB')
        ]);
    }
}
