<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePnjPengirimanDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pnj_pengiriman_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->double('pajak', 8, 3)->nullable();
            $table->string('unit')->nullable();
            $table->integer('jumlah_barang');
            $table->integer('harga');
            $table->timestamps();
            //fk
            $table->bigInteger('penerimaan_id')->nullable();
            $table->bigInteger('barang_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pnj_pengiriman_details');
    }
}
