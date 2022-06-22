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
        Schema::create('produk', function (Blueprint $table) {
            $table->increments('id_produk')->primary;
            $table->string('nama_produk', 155);
            $table->text('deskripsi');
            $table->string('foto', 155)->default('produk_default.jpg');
            $table->integer('harga')->unsigned();
            $table->string('kredit_akun_id', 155);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product');
    }
};
