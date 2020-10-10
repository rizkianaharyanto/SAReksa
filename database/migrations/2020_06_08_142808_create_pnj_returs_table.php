<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePnjRetursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pnj_returs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('kode_retur');
            $table->date('tanggal');
            $table->string('gudang');
            $table->integer('total_jenis_barang');
            $table->integer('total_harga');
            $table->double('diskon', 8, 3);
            $table->integer('biaya_lain');
            $table->integer('diskon_rp')->nullable();
            $table->enum('status', ['lunas', 'piutang'])->nullable();
            $table->enum('status_posting', ['belum posting', 'sudah posting'])->nullable();
            $table->timestamps();
            $table->softDeletes();
            //fk
            $table->bigInteger('pelanggan_id')->nullable();
            $table->bigInteger('penjual_id')->nullable();
            $table->bigInteger('faktur_id')->nullable();
            $table->bigInteger('jurnal_id')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pnj_returs');
    }
}
