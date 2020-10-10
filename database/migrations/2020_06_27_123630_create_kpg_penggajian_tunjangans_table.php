<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKpgPenggajianTunjangansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kpg_penggajian_tunjangans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('penggajian_id');
            $table->bigInteger('tunjangan_id');
            $table->string('jumlah_tunjangan');
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
        Schema::dropIfExists('kpg_penggajian_tunjangans');
    }
}
