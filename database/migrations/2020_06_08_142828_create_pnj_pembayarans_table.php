<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePnjPembayaransTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pnj_pembayarans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('kode_pembayaran');
            $table->integer('total');
            $table->date('tanggal');
            $table->timestamps();
            //fk
            $table->bigInteger('pelanggan_id')->nullable();
            $table->bigInteger('akun_id')->nullable();
            $table->bigInteger('jurnal_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pnj_pembayarans');
    }
}
