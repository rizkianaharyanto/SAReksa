<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStkGudangTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stk_gudang', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('kode_gudang')->nullable();
            $table->text('alamat');
            $table->text('no_telp');
            $table->enum('status', ['tidak aktif','aktif']);
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
        Schema::dropIfExists('stk_gudang');
    }
}
