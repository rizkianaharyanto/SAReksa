<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UnitSeeder::class,
            WarehouseSeeder::class,
            TaxSeeder::class,
            ItemSeeder::class,
        ]);
    }
}
