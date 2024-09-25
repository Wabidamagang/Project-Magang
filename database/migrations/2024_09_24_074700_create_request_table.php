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
        Schema::create('request', function (Blueprint $table) {
            $table->unsignedInteger('id')->autoIncrement();
            $table->unsignedInteger('kelas_id')->nullable();
            $table->unsignedInteger('mahasiswa_id')->nullable();
            $table->text('keterangan')->nullable();
            $table->timestamps();

            $table->foreign('kelas_id')->references('id')->on('kelas');
            $table->foreign('mahasiswa_id')->references('id')->on('mahasiswa');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('request');
    }
};
