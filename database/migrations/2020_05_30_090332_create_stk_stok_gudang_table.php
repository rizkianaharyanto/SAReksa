<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStkStokGudangTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stk_stok_gudang', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('gudang_id');
            $table->bigInteger('barang_id');
            $table->bigInteger('kuantitas');
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
        Schema::dropIfExists('stk_stok_gudang');
    }
}
