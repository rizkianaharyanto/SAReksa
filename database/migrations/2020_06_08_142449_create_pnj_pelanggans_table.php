<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePnjPelanggansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pnj_pelanggans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('kode_pelanggan');
            $table->string('nama_pelanggan', 100);
            $table->string('telp_pelanggan');
            $table->string('email_pelanggan');
            $table->string('alamat_pelanggan');
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
        Schema::dropIfExists('pnj_pelanggans');
    }
}
