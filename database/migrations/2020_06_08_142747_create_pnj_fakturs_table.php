<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePnjFaktursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pnj_fakturs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('kode_faktur');
            $table->date('tanggal');
            $table->integer('total_harga');
            $table->double('diskon', 8, 3);
            $table->integer('biaya_lain');
            $table->integer('uang_muka');
            $table->integer('diskon_rp')->nullable();
            $table->enum('status', ['lunas', 'piutang', 'dibayar sebagian'])->nullable();
            $table->enum('status_posting', ['belum posting', 'sudah posting'])->nullable();
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
        Schema::dropIfExists('pnj_fakturs');
    }
}
