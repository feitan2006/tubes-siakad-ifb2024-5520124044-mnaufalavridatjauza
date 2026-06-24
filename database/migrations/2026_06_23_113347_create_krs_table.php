<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('krs', function (Blueprint $table) {
            $table->id();
            $table->string('npm', 10);
            $table->string('kode_matakuliah', 8);
            $table->timestamps();

            $table->foreign('npm')->references('npm')->on('mahasiswas');
            $table->foreign('kode_matakuliah')->references('kode_matakuliah')->on('mata_kuliahs');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('krs');
    }
};