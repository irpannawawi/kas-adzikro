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
        Schema::create('kontak', function (Blueprint $table) {
            $table->increments('id_kontak')->primary;
            $table->string('kode_kontak', 155)->unique();
            $table->string('nama_kontak', 50);
            $table->string('email', 100)->nullable();
            $table->string('no_tlp', 15)->nullable();
            $table->text('alamat')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kontak');
    }
};
