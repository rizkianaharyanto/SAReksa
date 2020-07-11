<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStatusToStkStokOpnameTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('stk_stok_opname', function (Blueprint $table) {
            $table->enum('status', ['belum diposting', 'sudah posting']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('stk_stok_opname', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
}
