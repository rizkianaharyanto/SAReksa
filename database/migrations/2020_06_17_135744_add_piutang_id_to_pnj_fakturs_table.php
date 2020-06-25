<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPiutangIdToPnjFaktursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pnj_fakturs', function (Blueprint $table) {
            $table->bigInteger('piutang_id')->nullable();
        });
        Schema::table('pnj_returs', function (Blueprint $table) {
            $table->bigInteger('piutang_id')->nullable();
        });
    
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pnj_fakturs', function (Blueprint $table) {
            //
        });
        Schema::table('pnj_returs', function (Blueprint $table) {
        });
    }
}
