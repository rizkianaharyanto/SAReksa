<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePnjPemesanansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pnj_pemesanans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('kode_pemesanan');
            $table->date('tanggal');
            $table->string('gudang');
            $table->integer('total_jenis_barang');
            $table->integer('total_harga');
            $table->double('diskon', 8, 3);
            $table->integer('biaya_lain');
            $table->integer('diskon_rp')->nullable();
            $table->enum('status', ['baru','terkirim', 'terkirim sebagian'])->nullable();
            $table->timestamps();
            $table->softDeletes();
            //fk
            $table->bigInteger('pelanggan_id')->nullable();
            $table->bigInteger('penjual_id')->nullable();
            $table->bigInteger('penawaran_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pnj_pemesanans');
    }
}
