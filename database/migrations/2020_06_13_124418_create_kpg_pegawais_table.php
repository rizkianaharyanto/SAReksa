<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKpgPegawaisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kpg_pegawais', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nama');
            $table->string('ktp');
            $table->string('email');
            $table->string('handphone');
            $table->date('masuk');
            $table->string('catatan');
            $table->string('alamat');
            $table->string('kode_pos');
            $table->string('npwp');
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
        Schema::dropIfExists('kpg_pegawais');
    }
}
