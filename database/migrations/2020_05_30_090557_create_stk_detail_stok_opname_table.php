<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStkDetailStokOpnameTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stk_detail_stok_opname', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('stock_opname_id');
            $table->bigInteger('item_id');
            $table->integer('jumlah_tercatat')->nullable();
            $table->integer('jumlah_fisik')->nullable();
            
            
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
        Schema::dropIfExists('stk_detail_stok_opname');
    }
}
