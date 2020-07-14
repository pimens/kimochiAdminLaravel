<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Trxs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trxes', function (Blueprint $table) {
            $table->integer("id")->autoIncrement();
            $table->integer('id_user');
            $table->integer('id_makanan');
            $table->integer('id_cabang');
            $table->integer('jumlah');
            $table->integer('subtotal');
            $table->date('tanggal');
            $table->integer('notrx');
            $table->string('alamat');
            $table->integer('status');           
            $table->foreign('id_user')->references('id')->on('customers');
            $table->foreign('id_makanan')->references('id')->on('makanans');
            $table->foreign('id_cabang')->references('id')->on('cabangs');

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
        Schema::dropIfExists('trxes');
    }
}
