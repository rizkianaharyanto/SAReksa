<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePblPemasoksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pbl_pemasoks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('kode_pemasok');
            $table->string('nama_pemasok', 100);
            $table->string('telp_pemasok');
            $table->string('email_pemasok');
            $table->string('alamat_pemasok');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pbl_pemasoks');
    }
}
