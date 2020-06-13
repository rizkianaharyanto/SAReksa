<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKpgPphsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kpg_pphs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('batas_minimal');
            $table->integer('batas_maksimal');
            $table->double('persentase');
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
        Schema::dropIfExists('kpg_pphs');
    }
}
