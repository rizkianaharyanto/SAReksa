<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStkJurnalStokTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stk_jurnal_stok', function (Blueprint $table) {
            $table->id();
            $table->string('kode_ref');
            $table->bigInteger('units');
            $table->bigInteger('akun_debit');
            $table->bigInteger('akun_kredit');
            $table->bigInteger('debit');
            $table->bigInteger('kredit');
            
            
            // $table->float('jumlah');

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
        Schema::dropIfExists('stk_jurnal_stok');
    }
}
