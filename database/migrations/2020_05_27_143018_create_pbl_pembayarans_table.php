<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePblPembayaransTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pbl_pembayarans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('kode_pembayaran');
            $table->integer('total');
            $table->date('tanggal');
            $table->timestamps();
            //fk
            $table->bigInteger('pemasok_id')->nullable();
            $table->bigInteger('akun_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pbl_pembayarans');
    }
}
