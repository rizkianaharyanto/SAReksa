<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStkTransferStokTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stk_transfer_stok', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('kode_ref')->nullable();
            $table->bigInteger('gudang_asal');
            $table->bigInteger('gudang_tujuan');
            $table->bigInteger('akun_penyesuaian');
            $table->text('deskripsi')->nullable();
            $table->string('departemen');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stk_transfer_stok');
    }
}
