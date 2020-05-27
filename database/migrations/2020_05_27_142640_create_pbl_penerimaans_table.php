<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePblPenerimaansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pbl_penerimaans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('kode_penerimaan');
            $table->date('tanggal');
            $table->string('gudang');
            $table->integer('total_jenis_barang');
            $table->integer('total_harga');
            $table->double('diskon', 8, 3);
            $table->integer('biaya_lain');
            $table->timestamps();
            //fk
            $table->bigInteger('pemasok_id')->nullable();
            $table->bigInteger('pemesanan_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pbl_penerimaans');
    }
}
