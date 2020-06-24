<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveHargaGrosirFromStkMasterBarangTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('stk_master_barang', function (Blueprint $table) {
            $table->dropColumn('harga_grosir');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('stk_master_barang', function (Blueprint $table) {
            $table->float('harga_grosir');
        });
    }
}
