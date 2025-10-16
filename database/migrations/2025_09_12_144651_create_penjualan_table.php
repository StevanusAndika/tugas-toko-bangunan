<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('penjualan', function (Blueprint $table) {
            $table->id();
            $table->dateTime('tgl');
            $table->unsignedBigInteger('pengguna_id');
            $table->timestamps();

            $table->foreign('pengguna_id')
                  ->references('id')
                  ->on('karyawan')
                  ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('penjualan');
    }
};
