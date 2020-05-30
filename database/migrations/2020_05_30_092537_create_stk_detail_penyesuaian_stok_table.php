<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStkDetailPenyesuaianStokTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stk_detail_penyesuaian_stok', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('stock_adjustment_id');
            $table->bigInteger('item_id');
            $table->mediumInteger('quantity_diff');
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
        Schema::dropIfExists('stk_detail_penyesuaian_stok');
    }
}
