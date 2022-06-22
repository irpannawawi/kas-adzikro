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
        Schema::table('transaksi', function (Blueprint $table) {
            $table->foreign('id_produk')->references('id_produk')->on('produk');
            $table->foreign('id_kontak')->references('id_kontak')->on('kontak');
            $table->foreign('id_prson')->references('id_prson')->on('prson_level');
        });

        // relasi jurnal -> transaksi, akun
        Schema::table('jurnal', function (Blueprint $table) {
            $table->foreign('id_transaksi')->references('id_transaksi')->on('transaksi');
            $table->foreign('kode_akun')->references('kode_akun')->on('akun');
        });
        // relasi produk -> akun
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        
    }
};
