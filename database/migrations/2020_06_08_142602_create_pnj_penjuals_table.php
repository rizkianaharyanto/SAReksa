<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePnjPenjualsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pnj_penjuals', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('kode_penjual');
            $table->string('nama_penjual', 100);
            $table->string('telp_penjual');
            $table->string('email_penjual');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pnj_penjuals');
    }
}