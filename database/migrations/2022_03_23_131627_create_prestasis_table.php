<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prestasis', function (Blueprint $table) {
            $table->id();
            $table->string('nama_peserta');
            $table->string('nama_lomba');
            $table->string('nama_ekskuls');
            $table->string('prestasi');
            $table->string('nama_pelatih');
            $table->string('id_pelatih');
            $table->foreign('id_pelatih')->references('nim')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->date('tanggal');
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
        Schema::dropIfExists('prestasis');
    }
};