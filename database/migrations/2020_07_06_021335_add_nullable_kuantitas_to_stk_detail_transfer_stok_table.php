<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNullableKuantitasToStkDetailTransferStokTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('stk_detail_transfer_stok', function (Blueprint $table) {
            $table->integer('kuantitas')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('stk_detail_transfer_stok', function (Blueprint $table) {
            $table->integer('kuantitas')->nullable(false)->change();
        });
    }
}
