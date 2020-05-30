<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStkPenyesuaianStokTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stk_penyesuaian_stok', function (Blueprint $table) {
            $table->id();
            $table->string('kode_ref');
            $table->bigInteger('warehouse_id');
            $table->bigInteger('akun_penyesuaian');
            $table->text('deskripsi')->nullable();
            
            
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
        Schema::dropIfExists('stk_penyesuaian_stok');
    }
}
