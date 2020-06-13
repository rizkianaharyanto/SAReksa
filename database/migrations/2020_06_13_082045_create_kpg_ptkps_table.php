<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKpgPtkpsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kpg_ptkps', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('status_ptkp');
            $table->string('keterangan');
            $table->integer('gaji_minimal');
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
        Schema::dropIfExists('kpg_ptkps');
    }
}
