<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStatusToStkTransferStokTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('stk_transfer_stok', function (Blueprint $table) {
            $table->enum('status', ['belum posting','sudah posting']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('stk_transfer_stok', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
}
