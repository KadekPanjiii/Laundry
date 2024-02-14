<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tb_detail_transaksi', function (Blueprint $table) {
            $table->integer('id')->autoIncrement();
            $table->integer('id_transaksi')->nullable();
            $table->foreign('id_transaksi')->references('id')->on('tb_transaksi');
            $table->integer('id_paket')->nullable();
            $table->foreign('id_paket')->references('id')->on('tb_paket');
            $table->double('qty')->nullable();
            $table->text('keterangan')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_detail_transaksi');
    }
};
