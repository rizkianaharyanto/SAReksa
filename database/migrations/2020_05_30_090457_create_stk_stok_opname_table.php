<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStkStokOpnameTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stk_stok_opname', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('kode_ref');
            $table->bigInteger('gudang_id');
            $table->text('deskripsi')->nullable();
            $table->string('departemen')->nullable();
            $table->bigInteger('akun_penyesuaian');
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
        Schema::dropIfExists('stk_stok_opname');
    }
}
