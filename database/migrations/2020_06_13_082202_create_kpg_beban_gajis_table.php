<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKpgBebanGajisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kpg_beban_gajis', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('penggajian_id');
            $table->string('akun_beban');
            $table->integer('jumlah_beban');
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
        Schema::dropIfExists('kpg_beban_gajis');
    }
}
