<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePblPembayaranDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pbl_pembayaran_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('total');
            $table->timestamps();
            //fk
            $table->bigInteger('pembayaran_id')->nullable();
            $table->bigInteger('hutang_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pbl_pembayaran_details');
    }
}
