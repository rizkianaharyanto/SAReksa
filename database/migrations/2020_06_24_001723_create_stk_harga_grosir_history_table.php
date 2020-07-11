<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStkHargaGrosirHistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stk_harga_grosir_history', function (Blueprint $table) {
            $table->id();
            $table->float('harga_grosir', 11, 2);
            $table->unsignedBigInteger('item_id');
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
        Schema::dropIfExists('stk_harga_grosir_history');
    }
}
