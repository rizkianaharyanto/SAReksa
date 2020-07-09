<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveAkunFromStkMasterBarangTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('stk_master_barang', function (Blueprint $table) {
            $table->dropColumn('akun_persediaan');
            $table->dropColumn('akun_penjualan');
            $table->dropColumn('akun_hpp');
            $table->dropColumn('akun_pembelian');
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
            $table->bigInteger('akun_hpp');
            $table->bigInteger('akun_persediaan');
            $table->bigInteger('akun_penjualan');
            $table->bigInteger('akun_pembelian');
        });
    }
}
