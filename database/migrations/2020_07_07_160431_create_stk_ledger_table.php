<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStkLedgerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stk_ledger', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('kode_transaksi');
            $table->integer('qty_masuk');
            $table->integer('nilai_masuk');
            $table->integer('qty_keluar');
            $table->integer('nilai_keluar');
            $table->integer('sisa');
            //fk
            $table->bigInteger('barang_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stk_ledger');
    }
}
