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
        Schema::create('tb_paket', function (Blueprint $table) {
            $table->integer('id')->autoIncrement();
            $table->enum('jenis', ['kiloan', 'selimut', 'bed_cover', 'kaos', 'lain'])->nullable();
            $table->string('nama_paket', 100)->nullable();
            $table->integer('harga')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_paket');
    }
};
