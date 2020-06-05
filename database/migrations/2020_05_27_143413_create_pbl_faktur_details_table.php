<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePblFakturDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pbl_faktur_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->double('pajak', 8, 3)->nullable();
            $table->string('unit')->nullable();
            $table->enum('status_barang',['lunas', 'hutang'])->nullable();
            $table->integer('jumlah_barang');
            $table->integer('harga');
            $table->timestamps();
            //fk
            $table->bigInteger('faktur_id')->nullable();
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
        Schema::dropIfExists('pbl_faktur_details');
    }
}
