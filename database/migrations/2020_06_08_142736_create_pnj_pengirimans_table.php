<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePnjPengirimansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pnj_pengirimans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('kode_pengiriman');
            $table->date('tanggal');
            $table->string('gudang');
            $table->integer('total_jenis_barang');
            $table->integer('total_harga');
            $table->double('diskon', 8, 3);
            $table->integer('biaya_lain');
            $table->enum('status', ['sudah posting', 'terkirim', 'dalam pengiriman','selesai'])->nullable();
            $table->integer('diskon_rp')->nullable();
            $table->timestamps();
            $table->softDeletes();
            //fk
            $table->bigInteger('pelanggan_id')->nullable();
            $table->bigInteger('penjual_id')->nullable();
            $table->bigInteger('pemesanan_id')->nullable();
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
        Schema::dropIfExists('pnj_pengirimans');
    }
}
