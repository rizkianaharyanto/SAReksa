<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStatusToPnjPenawaransTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pnj_penawarans', function (Blueprint $table) {
            $table->enum('status', ['Telah dibuat pemesanan','Belum dibuat pemesanan'])->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pnj_penawarans', function (Blueprint $table) {
            //
        });
    }
}
