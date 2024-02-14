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
        Schema::create('tb_outlet', function (Blueprint $table) {
            $table->integer('id')->autoIncrement();
            $table->string('nama', 100)->nullable();
            $table->text('alamat')->nullable();
            $table->string('tlp', 15)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_outlet');
    }
};
