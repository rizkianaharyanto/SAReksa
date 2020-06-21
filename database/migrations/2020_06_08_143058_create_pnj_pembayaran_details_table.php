<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePnjPembayaranDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pnj_pembayaran_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('total');
            $table->timestamps();
            //fk
            $table->bigInteger('pembayaran_id')->nullable();
            $table->bigInteger('piutang_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pnj_pembayaran_details');
    }
}
