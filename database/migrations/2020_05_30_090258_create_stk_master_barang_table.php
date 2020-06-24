<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStkMasterBarangTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stk_master_barang', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('kode_barang');
            $table->bigInteger('kategori_barang');
            $table->string('nama_barang');
            $table->string('jenis_barang');
            $table->bigInteger('satuan_unit');
            $table->integer('harga_grosir');
            $table->string('item_image');
            $table->bigInteger('akun_hpp');
            $table->bigInteger('akun_persediaan');
            $table->bigInteger('akun_penjualan');
            $table->bigInteger('akun_pembelian');
            $table->bigInteger('pajak_id')->nullable();
            $table->bigInteger('supplier_id');
            $table->float('nilai_barang',10,4)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stk_master_barang');
    }
}
