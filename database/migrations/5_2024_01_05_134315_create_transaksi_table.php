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
        Schema::create('tb_transaksi', function (Blueprint $table) {
            $table->integer('id')->autoIncrement();
            $table->integer('id_outlet')->nullable();
            $table->foreign('id_outlet')->references('id')->on('tb_outlet');
            $table->string('kode_invoice', 100)->nullable();
            $table->integer('id_member')->nullable();
            $table->foreign('id_member')->references('id')->on('tb_member');
            $table->dateTime('tgl')->nullable();
            $table->dateTime('batas_waktu')->nullable();
            $table->dateTime('tgl_bayar')->nullable();
            $table->integer('biaya_tambahan')->nullable();
            $table->double('diskon')->nullable();
            $table->integer('pajak')->nullable();
            $table->double('total_bayar')->nullable();
            $table->enum('status', ['baru', 'proses' ,'selesai', 'diambil'])->nullable();
            $table->enum('dibayar', ['dibayar', 'belum_dibayar'])->nullable();
            $table->integer('id_user')->nullable();
            $table->foreign('id_user')->references('id')->on('tb_user');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_transaksi');
    }
};
