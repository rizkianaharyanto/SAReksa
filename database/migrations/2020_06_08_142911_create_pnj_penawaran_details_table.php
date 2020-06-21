<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePnjPenawaranDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pnj_penawaran_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->double('pajak', 8, 3)->nullable();
            $table->string('unit')->nullable();
            $table->integer('jumlah_barang')->nullable();
            $table->integer('harga')->nullable();
            $table->timestamps();
            //fk
            $table->bigInteger('penawaran_id')->nullable();
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
        Schema::dropIfExists('pnj_penawaran_details');
    }
}
