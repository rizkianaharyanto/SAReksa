<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePblFaktursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pbl_fakturs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('kode_faktur');
            $table->date('tanggal');
            $table->integer('total_harga');
            $table->double('diskon', 8, 3);
            $table->integer('biaya_lain');
            $table->integer('uang_muka');
            $table->enum('status', ['lunas', 'dibayar sebagian' , 'hutang'])->nullable();
            $table->enum('status_posting', ['konfirmasi', 'sudah posting'])->nullable();
            $table->timestamps();
            //fk
            $table->bigInteger('pemasok_id')->nullable();
            $table->bigInteger('pemesanan_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pbl_fakturs');
    }
}
