<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePnjPiutangsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pnj_piutangs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('kode_piutang');
            $table->integer('total_sisa');
            $table->timestamps();
            //fk
            $table->bigInteger('pelanggan_id')->nullable();
            $table->bigInteger('faktur_id')->nullable();
            $table->bigInteger('retur_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pnj_piutangs');
    }
}
