<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Makanan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('makanans', function (Blueprint $table) {
            // $table->increments('id');
            $table->integer("id")->autoIncrement();
            $table->string('nama');
            $table->double('harga');
            $table->string('gambar');
            $table->string('deskripsi');
            $table->string('kategori');
            $table->string('tmp');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('makanans');
    }
}
