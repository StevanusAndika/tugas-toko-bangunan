<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('penjualan_has_produk', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('penjualan_id');
            $table->unsignedBigInteger('produk_id');
            $table->integer('qty');
            $table->double('harga');
            $table->timestamps();

            $table->foreign('penjualan_id')
                ->references('id')
                ->on('penjualan')
                ->onDelete('cascade');

            $table->foreign('produk_id')
                  ->references('id')
                  ->on('produk')
                  ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('penjualan_has_produk');
    }
};
