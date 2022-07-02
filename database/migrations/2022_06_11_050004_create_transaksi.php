<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksi', function (Blueprint $table) {
            $table->increments('id_transaksi')->primary;
            $table->integer('id_produk')->unsigned()->nullable();
            $table->integer('id_user')->unsigned();
            $table->integer('id_kontak')->unsigned()->nullable();
            $table->integer('id_prson')->unsigned()->nullable();
            $table->string('keterangan', 255);
            $table->string('tanggal', 20);
            $table->integer('nominal');
            $table->enum('tipe', ['masuk', 'keluar']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transaksi');
    }
};
